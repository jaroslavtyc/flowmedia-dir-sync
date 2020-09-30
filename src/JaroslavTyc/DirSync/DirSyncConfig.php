<?php declare(strict_types=1);

namespace JaroslavTyc\DirSync;

use JaroslavTyc\DirSync\FileSystem\FileReader;
use JaroslavTyc\DirSync\FileSystem\JsonDecoder;

class DirSyncConfig extends StrictObject implements DirSyncConfigInterface
{
    public static function createFromJsonFile(string $jsonFile, FileReader $fileReader, JsonDecoder $jsonDecoder): DirSyncConfigInterface
    {
        $jsonString = $fileReader->readFile($jsonFile);
        return static::createFromJson($jsonString, $jsonDecoder);
    }

    public static function createFromJson(string $json, JsonDecoder $jsonDecoder): DirSyncConfigInterface
    {
        $values = $jsonDecoder->decode($json);
        return new static($values);
    }

    public static function createFromOptions(
        DirSyncOptionsInterface $dirSyncOptions,
        FileReader $fileReader,
        JsonDecoder $jsonDecoder
    ): DirSyncConfigInterface
    {
        return static::createFromJsonFile(
            $dirSyncOptions->getWorkingDir() . '/' . $dirSyncOptions->getJsonConfigPath(),
            $fileReader,
            $jsonDecoder
        );
    }

    /**
     * @var array
     */
    private $values;

    public function __construct(array $values)
    {
        $this->values = $values;
    }

    public function getAsJson(): string
    {
        return json_encode($this->getAsArray(), JSON_UNESCAPED_UNICODE);
    }

    public function getAsArray(): array
    {
        return $this->values;
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->getAsArray());
    }

}
