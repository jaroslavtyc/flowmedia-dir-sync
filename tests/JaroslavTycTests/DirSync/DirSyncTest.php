<?php declare(strict_types=1);

namespace JaroslavTycTests\DirSync;

use JaroslavTyc\DirSync\ActionsRunner;
use JaroslavTyc\DirSync\DirSync;
use JaroslavTyc\DirSync\DirSyncConfig;
use JaroslavTyc\DirSync\FileSystem\DirCreator;
use JaroslavTycTests\DirSync\Exceptions\DeleteFileException;
use JaroslavTycTests\DirSync\Exceptions\ReadDirException;
use PHPUnit\Framework\TestCase;

class DirSyncTest extends TestCase
{
    /**
     * @var string
     */
    private $testDir;

    protected function setUp(): void
    {
        parent::setUp();
        $this->initializeUniqueTestDir();
    }

    private function initializeUniqueTestDir()
    {
        $testDir = sys_get_temp_dir() . '/' . uniqid('dir_sync_test', true);
        self::getDirCreator()->createDir($testDir);
        $this->testDir = $testDir;
    }

    protected static function getDirCreator(): DirCreator
    {
        static $dirCreator;
        if (!$dirCreator) {
            $dirCreator = new DirCreator();
        }
        return $dirCreator;
    }

    protected function tearDown(): void
    {
        if ($this->testDir) {
            $this->removeDirWithFiles($this->testDir);
        }
    }

    private function removeDirWithFiles(string $dir)
    {
        $folders = $this->getFoldersInDir($dir);
        foreach ($folders as $folder) {
            is_dir("$dir/$folder")
                ? $this->removeDirWithFiles("$dir/$folder")
                : $this->removeFile("$dir/$folder");
        }
        $this->removeEmptyDir($dir);
    }

    private function getFoldersInDir(string $dir): array
    {
        $folders = scandir($dir);
        if ($folders === false) {
            throw new ReadDirException(sprintf("Can not read dir '%s'", $dir));
        }
        return array_diff($folders, ['.', '..']);
    }

    private function removeFile(string $file)
    {
        if (!unlink($file) && file_exists($file)) {
            throw new DeleteFileException(sprintf("Can not delete file '%s'", $file));
        }
    }

    private function removeEmptyDir(string $dir)
    {
        if (!rmdir($dir) && file_exists($dir)) {
            throw new DeleteFileException(sprintf("Can not delete dir '%s'", $dir));
        }
    }

    /**
     * @test
     */
    public function I_can_sync_dir()
    {
        $foldersBeforeSync = $this->getFoldersInDir($this->testDir);
        self::assertSame([], $foldersBeforeSync);
        $dirSync = new DirSync(new DirSyncConfig([]), new ActionsRunner());
        $dirSync->syncAginstDir($this->testDir, false);
        $createdFolders = $this->getFoldersInDir($this->testDir);
        self::assertSame([], $createdFolders); // TODO sync something
    }
}
