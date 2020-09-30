<?php declare(strict_types=1);

namespace JaroslavTycTests\DirSync;

use JaroslavTyc\DirSync\DirSyncConfig;
use JaroslavTyc\DirSync\FileSystem\FileReader;
use JaroslavTyc\DirSync\FileSystem\JsonDecoder;
use PHPUnit\Framework\TestCase;

class DirSyncOptionsTest extends TestCase
{
    /**
     * @test
     */
    public function I_can_create_it_from_json_string()
    {
        $dirSyncOptions = DirSyncConfig::createFromJson('{"something": "exceptional"}', new JsonDecoder());
        self::assertSame(['something' => 'exceptional'], $dirSyncOptions->getAsArray());
        self::assertSame('{"something":"exceptional"}', $dirSyncOptions->getAsJson());
    }

    /**
     * @test
     */
    public function I_can_create_it_from_json_file()
    {
        $dirSyncOptions = DirSyncConfig::createFromJsonFile(__DIR__ . '/stub/dir-sync-options.json', new FileReader(), new JsonDecoder());
        self::assertSame(['thisIs' => 'it'], $dirSyncOptions->getAsArray());
        self::assertSame('{"thisIs":"it"}', $dirSyncOptions->getAsJson());
    }

    /**
     * @test
     */
    public function I_can_create_it_directly()
    {
        $dirSyncConfig = new DirSyncConfig(['foo']);
        self::assertSame(['foo'], $dirSyncConfig->getAsArray());
    }
}
