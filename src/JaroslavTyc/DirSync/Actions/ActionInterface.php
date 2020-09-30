<?php

namespace JaroslavTyc\DirSync\Actions;

interface ActionInterface
{
    public function getName(): string;

    public function runAction($context, string $workingDir, bool $dryRun);
}