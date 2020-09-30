<?php declare(strict_types=1);

namespace JaroslavTycTests\DirSync;

use JaroslavTyc\DirSync\DirSyncOptions;
use PHPUnit\Framework\TestCase;

class DirSyncOptionsTest extends TestCase
{
    /**
     * @test
     */
    public function I_can_create_it_from_json_string()
    {
        $dirSyncOptions = DirSyncOptions::createFromJson(<<<JSON
{
    "something": "exceptional"
}
JSON
        );
        self::assertSame(['something' => 'exceptional'], $dirSyncOptions->getAsArray());
        self::assertSame('{"something":"exceptional"}', $dirSyncOptions->getAsJson());
    }

    /**
     * @test
     */
    public function I_can_create_it_from_json_file()
    {
        $dirSyncOptions = DirSyncOptions::createFromJsonFile(__DIR__ . '/stub/dir-sync-options.json');
        self::assertSame(['thisIs' => 'it'], $dirSyncOptions->getAsArray());
        self::assertSame('{"thisIs":"it"}', $dirSyncOptions->getAsJson());
    }
}
