<?php

declare(strict_types=1);

namespace Ngmy\PharExtractor\Phar\Finder;

use InvalidArgumentException;
use Ngmy\PharExtractor\Phar;
use Ngmy\PharExtractor\Phars;
use Ngmy\TypedArray\TypedArray;
use Symfony\Component\Finder\Finder;

use function is_dir;
use function pathinfo;
use function sprintf;

use const PATHINFO_EXTENSION;

class Directory implements Phar\Finder
{
    /** @var Finder */
    private $finder;

    public function __construct(string $directory)
    {
        if (!is_dir($directory)) {
            throw new InvalidArgumentException(sprintf('The directory "%s" does not exists.', $directory));
        }
        $this->finder = new Finder();
        $this->finder->files()->followLinks()->in($directory);
    }

    public function find(): Phars
    {
        $phars = TypedArray::new()->withIntKey()->withClassValue(Phar::class);
        if (!$this->finder->hasResults()) {
            return new Phars($phars);
        }
        /** @psalm-var \Symfony\Component\Finder\SplFileInfo $file */
        foreach ($this->finder as $file) {
            if ($file->getRealPath() === false) {
                continue;
            }
            if (pathinfo($file->getRealPath(), PATHINFO_EXTENSION) != 'phar') {
                continue;
            }
            $phars[] = new Phar(
                $file->getBasename(),
                $file->getRealPath()
            );
        }
        return new Phars($phars);
    }
}
