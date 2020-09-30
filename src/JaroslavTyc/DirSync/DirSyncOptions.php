<?php declare(strict_types=1);

namespace JaroslavTyc\DirSync;

class DirSyncOptions extends StrictObject implements DirSyncOptionsInterface
{
    public static function createFromJsonFile(string $jsonFile): DirSyncOptionsInterface
    {
        $jsonString = FileReader::fetchFile($jsonFile);
        return static::createFromJson($jsonString);
    }

    public static function createFromJson(string $json): DirSyncOptionsInterface
    {
        $options = JsonReader::decode($json);
        return new static($options);
    }

    /**
     * @var array
     */
    private $options;

    public function __construct(array $options)
    {
        $this->guardKnownOptionsOnly($options);
        $this->options = $options;
    }

    private function guardKnownOptionsOnly(array $options)
    {
        // TODO
    }

    public function getAsJson(): string
    {
        return json_encode($this->getAsArray(), JSON_UNESCAPED_UNICODE);
    }

    public function getAsArray(): array
    {
        return $this->options;
    }
}
