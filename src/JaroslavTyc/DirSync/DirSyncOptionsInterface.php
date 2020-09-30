<?php declare(strict_types=1);

namespace JaroslavTyc\DirSync;

interface DirSyncOptionsInterface
{
    public function getAsJson(): string;

    public function getAsArray(): array;
}
