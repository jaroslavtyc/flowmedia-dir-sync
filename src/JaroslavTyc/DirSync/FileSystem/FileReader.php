<?php declare(strict_types=1);

namespace JaroslavTyc\DirSync\FileSystem;

use JaroslavTyc\DirSync\Exceptions\UnreadableFileException;
use JaroslavTyc\DirSync\StrictObject;

class FileReader extends StrictObject
{
    public function readFile(string $file): string
    {
        if (!is_readable($file)) {
            throw new UnreadableFileException(sprintf(
                "File '%s' is not readable"
                . " (current working directory, used if the file path is relative, was '%s')."
                . " Make sure the file exists and current user '%s' has rights to read it.",
                $file,
                getcwd(),
                posix_getpwuid(posix_geteuid())['name']
            ));
        }
        $content = file_get_contents($file);
        if ($content === false) {
            throw new UnreadableFileException(sprintf("Fetching content of file '%s' failed.", $file));
        }
        return $content;
    }
}
