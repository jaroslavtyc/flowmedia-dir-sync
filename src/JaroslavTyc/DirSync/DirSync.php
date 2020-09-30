<?php declare(strict_types=1);

namespace JaroslavTyc\DirSync;

use JaroslavTyc\DirSync\Exceptions\InvalidWorkingDirException;

class DirSync extends StrictObject
{
    /**
     * @var DirSyncConfigInterface
     */
    private $dirSyncConfig;
    /**
     * @var ActionsRunner
     */
    private $actionsRunner;

    public function __construct(
        DirSyncConfigInterface $dirSyncConfig,
        ActionsRunner $actionsRunner
    )
    {
        $this->dirSyncConfig = $dirSyncConfig;
        $this->actionsRunner = $actionsRunner;
    }

    public function syncAginstDir(string $workingDir, bool $dryRun = false)
    {
        $sanitizedWorkingDir = $this->sanitizeWorkingDir($workingDir);
        $this->checkWorkingDir($sanitizedWorkingDir);
        foreach ($this->dirSyncConfig as $actionKey => $actionContext) {
            $this->actionsRunner->runActionByKey(
                $actionKey,
                $actionContext,
                $sanitizedWorkingDir,
                $dryRun
            );
        }
    }

    private function sanitizeWorkingDir(string $workingDir): string
    {
        $sanitizedWorkingDir = trim($workingDir);
        if ($sanitizedWorkingDir === '') {
            throw new InvalidWorkingDirException(sprintf("Given working directory '%s' is empty", $workingDir));
        }
        return $sanitizedWorkingDir;
    }

    private function checkWorkingDir(string $workingDir)
    {
        if (!is_writable($workingDir)) {
            throw new InvalidWorkingDirException(sprintf("Can not write into given working directory '%s'", $workingDir));
        }
    }
}
