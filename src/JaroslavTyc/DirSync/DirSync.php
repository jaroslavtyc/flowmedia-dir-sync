<?php declare(strict_types=1);

namespace JaroslavTyc\DirSync;

use JaroslavTyc\DirSync\Exceptions\InvalidWorkingDirException;

class DirSync extends StrictObject
{
    /**
     * @var DirSyncOptionsInterface
     */
    private $dirSyncOptions;

    public function __construct(DirSyncOptionsInterface $dirSyncOptions)
    {
        $this->dirSyncOptions = $dirSyncOptions;
    }

    public function syncAginstDir(string $workingDir)
    {
        $sanitizedWorkingDir = $this->sanitizeWorkingDir($workingDir);
        // TODO
    }

    private function sanitizeWorkingDir(string $workingDir): string
    {
        $sanitizedWorkingDir = trim($workingDir);
        if ($sanitizedWorkingDir === '') {
            throw new InvalidWorkingDirException(sprintf("Given working directory '%s' is empty", $workingDir));
        }
        return $sanitizedWorkingDir;
    }

}
