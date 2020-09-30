<?php declare(strict_types=1);

namespace JaroslavTyc\DirSync;

interface DirSyncConfigInterface extends \IteratorAggregate
{
    public function getAsJson(): string;

    public function getAsArray(): array;
}
