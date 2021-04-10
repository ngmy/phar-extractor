<?php

declare(strict_types=1);

namespace Ngmy\PharExtractor\Tests\Feature\Console\Command;

use Ngmy\PharExtractor\Tests\TestCase;
use Symfony\Component\Finder\Finder;

use function exec;

abstract class ExtractorTestCase extends TestCase
{
    /** @var string */
    protected $pathTo;
    /** @var Finder */
    protected $finder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pathTo = $this->getUniqueTemporaryFilePath();
        $this->finder = new Finder();
    }

    protected function tearDown(): void
    {
        exec('rm -rf ' . $this->pathTo);

        parent::tearDown();
    }
}
