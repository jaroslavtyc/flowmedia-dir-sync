<?php declare(strict_types=1);

namespace JaroslavTycTests\DirSync;

use JaroslavTyc\DirSync\DirSync;
use JaroslavTyc\DirSync\DirSyncOptions;
use PHPUnit\Framework\TestCase;

class DirSyncTest extends TestCase
{
    /**
     * @test
     */
    public function I_can_crete_instance_of_it()
    {
        $dirSync = new DirSync(sys_get_temp_dir(), new DirSyncOptions());
        self::assertInstanceOf(DirSync::class, $dirSync);
    }
}
