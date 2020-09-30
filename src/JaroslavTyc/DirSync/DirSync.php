<?php declare(strict_types=1);

namespace JaroslavTyc\DirSync;

class DirSync extends StrictObject
{
    /**
     * @var string
     */
    private $workingDir;
    /**
     * @var DirSyncOptionsInterface
     */
    private $dirSyncOptions;

    public function __construct(string $workingDir, DirSyncOptionsInterface $dirSyncOptions)
    {
        $this->workingDir = $this->sanitizeWorkingDir($workingDir);
        $this->dirSyncOptions = $dirSyncOptions;
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
