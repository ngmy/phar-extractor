<?php

declare(strict_types=1);

namespace Ngmy\PharExtractor;

use Phar as PhpPhar;
use PharException;
use UnexpectedValueException;

use const DIRECTORY_SEPARATOR;

class Phar
{
    /** @var string */
    private $name;
    /** @var PhpPhar */
    private $phpPhar;

    /**
     * @throws UnexpectedValueException
     */
    public function __construct(string $name, string $location)
    {
        $this->name = $name;
        $this->phpPhar = new PhpPhar($location);
    }

    /**
     * @param list<string>|string|null $files
     * @throws PharException
     */
    public function extractTo(string $directory, $files = null, bool $overwrite = false): void
    {
        $this->phpPhar->extractTo($directory . DIRECTORY_SEPARATOR . $this->name, $files, $overwrite);
    }
}
