<?php

namespace JaroslavTyc\DirSync;

interface ActionsRunnerInterface
{
    /**
     * @param string $action
     * @param array|bool|null $context
     * @param string $workingDir
     * @param bool $dryRun
     */
    public function runActionByKey(string $action, $context, string $workingDir, bool $dryRun);
}