<?php declare(strict_types=1);

namespace JaroslavTyc\DirSync\FileSystem;

use JaroslavTyc\DirSync\Exceptions\InvalidJsonException;
use JaroslavTyc\DirSync\StrictObject;

class JsonDecoder extends StrictObject
{
    public function decode(string $json): array
    {
        $decoded = json_decode($json, true);
        if ($decoded === null) {
            throw new InvalidJsonException(
                sprintf(
                    "Given JSON can not be decoded to an array:\nerror code %d\nerror message: '%s'",
                    json_last_error(),
                    json_last_error_msg()
                )
            );
        }
        return $decoded;
    }
}
