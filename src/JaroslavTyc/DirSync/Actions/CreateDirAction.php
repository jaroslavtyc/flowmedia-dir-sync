<?php declare(strict_types=1);

namespace JaroslavTyc\DirSync\Actions;

use JaroslavTyc\DirSync\Actions\Exceptions\CreateDirActionException;
use JaroslavTyc\DirSync\Actions\Exceptions\InvalidCreateDirActionValueException;
use JaroslavTyc\DirSync\FileSystem\DirCreator;
use JaroslavTyc\DirSync\StrictObject;

class CreateDirAction extends StrictObject implements ActionInterface
{
    /**
     * @var DirCreator
     */
    private $dirCreator;

    public function __construct(DirCreator $dirCreator)
    {
        $this->dirCreator = $dirCreator;
    }

    public function getName(): string
    {
        return '#CreateDir';
    }

    public function runAction($dirName, string $workingDir, bool $dryRun)
    {
        if (!$dirName || !is_string($dirName)) {
            throw new InvalidCreateDirActionValueException(
                sprintf("'%s' action requires name of dir to create, got '%s'", $this->getName(), var_dump($dirName))
            );
        }
        $dirPath = $workingDir . '/' . $dirName;
        if (file_exists($dirPath) && !is_dir($dirPath)) {
            throw new CreateDirActionException(
                sprintf("Can not create dir '%s' as the name is already occupied by a file", $dirPath)
            );
        }
        if ($dryRun) {
            return;
        }
        $this->dirCreator->createDir($dirPath);
    }

}
