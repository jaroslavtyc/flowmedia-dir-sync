<?php declare(strict_types=1);

namespace JaroslavTycTests\DirSync;

use JaroslavTyc\DirSync\DirSync;
use PHPUnit\Framework\TestCase;

class DirSyncTest extends TestCase
{
    /**
     * @test
     */
    public function I_can_crete_instance_of_it()
    {
        $dirSync = new DirSync();
        self::assertInstanceOf(DirSync::class, $dirSync);
    }
}
