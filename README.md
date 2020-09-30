# Proof of my skills to get a job

**NOT a production-ready code!**

Use at your own risk.

*But I will be happy if you will get inspired by this 😉*

## Purpose

I should be able to create a [standalone](#standalone), [independent](#independent) library to control directories by a JSON configuration and CLI. With use of object-oriented programming and PHP (in a version of my choice).

### Standalone

This library should be runnable just by a terminal emulator and a PHP executable.

*for example:*
```shell script
php ./bin/dirsync --dry-run
```

### Independent

No other libraries should be used (not even shinnies as the [Symfony Console](https://symfony.com/doc/current/components/console.html#installation)).

### Usage

Create a JSON file with configuration directives:
- key starting with a hash sign `#` is processed as an **Action**, value (scalar, array, object...) is then used as a parameter to `Action->runAction` itself
  - see `\JaroslavTyc\DirSync\Actions\ActionInterface` for details
- key **not** starting by a hash sign `#` is considered as a dir name and is used for **Create Dir Action** directly as a value
  - any value pointed by that JSON key will be ignored (hint: use `null` there)
  - see `\JaroslavTyc\DirSync\Actions\CreateDirAction` for details 

*for example:*
```json
{
    "NewDirByDirSyncDirectName": null,
    "#CreateDir": "NewDirByDirSyncCreateDirAction"
}
```

Process it:

```shell script
php ./bin/dirsync --json-config=json_config_file_for_dir_sync.json
```

Should create two empty directories `NewDirByDirSyncDirectName` and `NewDirByDirSyncCreateDirAction` in a current working directory.

### More Actions

Create your own **Action** implementing `\JaroslavTyc\DirSync\Actions\ActionInterface` and register them to `\JaroslavTyc\DirSync\ActionsRunner`.

*for example:*

```php
<?php
namespace JaroslavTyc\DirSync;
use JaroslavTyc\DirSync\Actions\ActionInterface;

class DeleteDirAction implements ActionInterface {
    public function getName() : string{
         return '#DeleteDir';
    }
    public function runAction($context,string $workingDir, bool $dryRun){
        // some nasty destroying code
    }
}

$actionsRunner = new ActionsRunner();
$actionsRunner->registerAction(new DeleteDirAction());
```

### Original task

All of this comes from the [original Flowmedia task](original_task/index.html).

### Differences against original task

- `root dir` renamed to `working dir`, as root dir has specific meaning in Linux
- `working dir` (formerly `root dir`) has to be provided explicitly to the synchronization method itself to avoid accidents and confusion
- all configuration options, except `working dir`, are wrapped by interface `DirSyncOptionsInterface`, most of them originally enclosed by original task `DirSyncInterface`

## Installation 

The easiest way is to get it via [composer](https://getcomposer.org/):

```sh
php composer.phar require "jaroslavtyc/dir-sync:~1.0"
```