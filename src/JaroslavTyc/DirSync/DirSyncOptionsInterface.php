<?php declare(strict_types=1);

namespace JaroslavTyc\DirSync;

interface DirSyncOptionsInterface
{
    public function getJsonConfigPath(): string;

    public function getWorkingDir(): string;

    public function isDryRun(): bool;
}
