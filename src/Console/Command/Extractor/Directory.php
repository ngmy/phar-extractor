<?php

declare(strict_types=1);

namespace Ngmy\PharExtractor\Console\Command\Extractor;

use Ngmy\PharExtractor\Console;
use Ngmy\PharExtractor\Phar;
use PharException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class Directory extends Command
{
    protected static $defaultName = 'extract-dir';

    protected function configure(): void
    {
        $this
            ->setDescription('Extract the contents of PHAR archives in a directory to a directory')
            ->addArgument(
                'path_from',
                InputArgument::REQUIRED,
                'Path to extract from',
            )
            ->addOption(
                'path_to',
                't',
                InputOption::VALUE_REQUIRED,
                'Path to extract to',
                '.'
            )
            ->addOption(
                'overwrite',
                null,
                InputOption::VALUE_NONE,
                'Set to enable overwriting existing files'
            )
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @psalm-var string $pathFrom */
        $pathFrom = $input->getArgument('path_from');
        /** @psalm-var string $pathTo */
        $pathTo = $input->getOption('path_to');
        /** @psalm-var bool $overwrite */
        $overwrite = $input->getOption('overwrite');

        $io = new SymfonyStyle($input, $output);
        $finder = new Phar\Finder\Directory($pathFrom);
        $phars = $finder->find();
        if ($phars->count() == 0) {
            return Command::SUCCESS;
        }
        new Console\ProgressObserver($phars, $io);
        try {
            $phars->extractTo($pathTo, null, $overwrite);
        } catch (PharException $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }
        return Command::SUCCESS;
    }
}
