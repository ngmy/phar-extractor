<?php

declare(strict_types=1);

namespace Ngmy\PharExtractor\Tests\Feature\Console\Command\Extractor;

use Ngmy\PharExtractor\Console\Command;
use Ngmy\PharExtractor\Tests\Feature\Console\Command\ExtractorTestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

use const DIRECTORY_SEPARATOR;

class PhiveXmlTest extends ExtractorTestCase
{
    public function testExecute(): void
    {
        $application = new Application();
        $application->add(new Command\Extractor\PhiveXml());

        $command = $application->find('extract-phive-xml');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'path_from' => __DIR__
                . DIRECTORY_SEPARATOR . '..'
                . DIRECTORY_SEPARATOR . '..'
                . DIRECTORY_SEPARATOR . '..'
                . DIRECTORY_SEPARATOR . '..'
                . DIRECTORY_SEPARATOR . 'Data'
                . DIRECTORY_SEPARATOR . 'phars.xml'
                ,
            '-t' => $this->pathTo,
        ]);

        $this->finder->directories()->in($this->pathTo)->notPath([
            'humbug',
            'phpcbf',
            'phpcs',
        ]);

        $this->assertCount(0, $this->finder);
        $this->assertDirectoryExists($this->pathTo . DIRECTORY_SEPARATOR . 'humbug' . DIRECTORY_SEPARATOR . 'box');
        $this->assertDirectoryExists($this->pathTo . DIRECTORY_SEPARATOR . 'phpcbf');
        $this->assertDirectoryExists($this->pathTo . DIRECTORY_SEPARATOR . 'phpcs');
    }
}
