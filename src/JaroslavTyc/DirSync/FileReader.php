<?php declare(strict_types=1);

namespace JaroslavTyc\DirSync;

use JaroslavTyc\DirSync\Exceptions\UnreadableFile;

class FileReader extends StrictObject
{
    public static function fetchFile(string $file): string
    {
        if (!is_readable($file)) {
            throw new UnreadableFile(sprintf(
                "File '%s' is not readable. Current working directory, used if file path is relative, is '%s'."
                . " Make sure it exists and current user '%s' has rights to read it.",
                $file,
                getcwd(),
                posix_getpwuid(posix_geteuid())['name']
            ));
        }
        $content = file_get_contents($file);
        if ($content === false) {
            throw new UnreadableFile(sprintf("Fetching content of file '%s' failed.", $file));
        }
        return $content;
    }
}
