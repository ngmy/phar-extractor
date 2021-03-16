<?php

declare(strict_types=1);

namespace Ngmy\PharExtractor\Tests;

use PHPUnit\Framework\TestCase as PhpUnitTestCase;

use function file_exists;
use function sys_get_temp_dir;
use function uniqid;

use const DIRECTORY_SEPARATOR;

abstract class TestCase extends PhpUnitTestCase
{
    protected function getUniqueTemporaryFilePath(): string
    {
        while (true) {
            $name = uniqid('phar-extractor-', true);
            $path = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $name;
            if (!file_exists($path)) {
                return $path;
            }
        }
    }
}
