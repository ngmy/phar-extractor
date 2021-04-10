<?php

declare(strict_types=1);

namespace Ngmy\PharExtractor\Phar;

use Ngmy\PharExtractor\Phars;

interface Finder
{
    public function find(): Phars;
}
