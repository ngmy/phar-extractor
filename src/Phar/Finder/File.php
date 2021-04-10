<?php

declare(strict_types=1);

namespace Ngmy\PharExtractor\Phar\Finder;

use InvalidArgumentException;
use Ngmy\PharExtractor\Phar;
use Ngmy\PharExtractor\Phars;
use Ngmy\TypedArray\TypedArray;

use function basename;
use function is_file;
use function pathinfo;
use function realpath;
use function sprintf;

use const PATHINFO_EXTENSION;

class File implements Phar\Finder
{
    /** @var string */
    private $file;

    public function __construct(string $file)
    {
        if (!is_file($file)) {
            throw new InvalidArgumentException(sprintf('The file "%s" does not exists.', $file));
        }
        $this->file = $file;
    }

    public function find(): Phars
    {
        $phars = TypedArray::new()->withIntKey()->withClassValue(Phar::class);
        if (realpath($this->file) === false) {
            return new Phars($phars);
        }
        if (pathinfo(realpath($this->file), PATHINFO_EXTENSION) != 'phar') {
            return new Phars($phars);
        }
        $phars[] = new Phar(
            basename($this->file),
            realpath($this->file),
        );
        return new Phars($phars);
    }
}
