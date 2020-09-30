<?php declare(strict_types=1);

namespace JaroslavTyc\DirSync;

class DirSyncOptions extends StrictObject implements DirSyncOptionsInterface
{
    public const JSON_CONFIG_PATH = 'json_config_path';
    public const DRY_RUN = 'dry_run';
    public const WORKING_DIR = 'working_dir';

    private $jsonConfigPath;
    private $dryRun;
    private $workingDir;

    public function __construct(array $options)
    {
        // TODO validate values
        $this->jsonConfigPath = !empty($options[static::JSON_CONFIG_PATH])
            ? (string)$options[static::JSON_CONFIG_PATH]
            : 'dirsync.json';
        $this->dryRun = (bool)($options[static::DRY_RUN] ?? false);
        $this->workingDir = !empty($options[static::WORKING_DIR])
            ? (string)$options[static::WORKING_DIR]
            : getcwd();
    }

    public function getJsonConfigPath(): string
    {
        return $this->jsonConfigPath;
    }

    public function getWorkingDir(): string
    {
        return $this->workingDir;
    }

    public function isDryRun(): bool
    {
        return $this->dryRun;
    }

}
