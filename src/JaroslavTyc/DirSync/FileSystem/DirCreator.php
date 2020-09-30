<?php declare(strict_types=1);

namespace JaroslavTyc\DirSync\FileSystem;

use JaroslavTyc\DirSync\FileSystem\Exceptions\DirCreationException;
use JaroslavTyc\DirSync\StrictObject;

class DirCreator extends StrictObject
{
    public function createDir(string $dir)
    {
        if (!file_exists($dir) && !@mkdir($dir, 0700, false) && !is_dir($dir)) {
            throw new DirCreationException(sprintf("Can not create dir '%s'", $dir));
        }
    }
}
