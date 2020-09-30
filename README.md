# Proof of my skills to get a job

**NOT a production-ready code!**

Use at your own risk.

*But I will be happy if you will get inspired by this 😉*

## Purpose

I should be able to create a [standalone](#standalone), [independent](#independent) library to control directories by a JSON configuration and CLI. With use of object-oriented programming and PHP (in a version of my choice).

### Standalone

This library should be runnable just by a terminal emulator and a PHP executable.

For example
```shell script
php ./bin/dirsync --dry-run
```

### Independent

No other libraries should be used (not even shinnies as the [Symfony Console](https://symfony.com/doc/current/components/console.html#installation)).

### Original task

All of this comes from the [original Flowmedia task](original_task/index.html).

## Installation

The easiest way is to get it via [composer](https://getcomposer.org/):

```sh
php composer.phar require "jaroslavtyc/dir-sync:~1.0"
```