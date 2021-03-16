<?php

declare(strict_types=1);

namespace Ngmy\PharExtractor;

use Ngmy\Observer\Subject;
use Ngmy\TypedArray\TypedArray;
use PharException;

use function count;

class Phars extends Subject
{
    /**
     * @var TypedArray<int, Phar>
     * @phpstan-var TypedArray<int|null, Phar>
     * @psalm-var TypedArray<int|null, Phar>
     */
    private $phars;

    /**
     * @param TypedArray<int, Phar> $phars
     *
     * @phpstan-param TypedArray<int|null, Phar> $phars
     *
     * @psalm-param TypedArray<int|null, Phar> $phars
     */
    public function __construct(TypedArray $phars)
    {
        $this->phars = $phars;
    }

    public function count(): int
    {
        return count($this->phars);
    }

    /**
     * @param array<int, string>|string|null $files
     * @throws PharException
     *
     * @phpstan-param list<string>|string|null $files
     *
     * @psalm-param list<string>|string|null $files
     */
    public function extractTo(string $directory, $files = null, bool $overwrite = false): void
    {
        /**
         * @phpstan-var int $i
         * @psalm-ignore-var
         */
        foreach ($this->phars as $i => $phar) {
            $phar->extractTo($directory, $files, $overwrite);
            unset($this->phars[$i]);
            $this->notify();
        }
    }
}
