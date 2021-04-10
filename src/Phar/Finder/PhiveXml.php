<?php

declare(strict_types=1);

namespace Ngmy\PharExtractor\Phar\Finder;

use DOMDocument;
use Ngmy\PharExtractor\Phar;
use Ngmy\PharExtractor\Phars;
use Ngmy\TypedArray\TypedArray;

use function assert;
use function is_null;
use function pathinfo;
use function realpath;

use const DIRECTORY_SEPARATOR;
use const PATHINFO_EXTENSION;

class PhiveXml implements Phar\Finder
{
    /** @var DOMDocument */
    private $xml;

    public function __construct(string $file = '.phive' . DIRECTORY_SEPARATOR . 'phars.xml')
    {
        $xml = new DOMDocument('1.0', 'utf-8');
        $xml->preserveWhiteSpace = false;
        $xml->formatOutput = true;
        $xml->load($file);
        $this->xml = $xml;
    }

    public function find(): Phars
    {
        $phars = TypedArray::new()->withIntKey()->withClassValue(Phar::class);
        $pharNodes = $this->xml->getElementsByTagName('phar');
        if ($pharNodes->count() == 0) {
            return new Phars($phars);
        }
        foreach ($pharNodes as $pharNode) {
            $attributes = $pharNode->attributes;
            /** @psalm-suppress RedundantCondition */
            assert(!is_null($attributes));
            $name = $attributes->getNamedItem('name');
            assert(!is_null($name));
            $location = $attributes->getNamedItem('location');
            assert(!is_null($location));
            $realPath = realpath($location->nodeValue);
            if ($realPath === false) {
                continue;
            }
            if (pathinfo($realPath, PATHINFO_EXTENSION) != 'phar') {
                continue;
            }
            $phars[] = new Phar(
                $name->nodeValue,
                $realPath
            );
        }
        return new Phars($phars);
    }
}
