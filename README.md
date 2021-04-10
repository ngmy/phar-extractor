# PHAR Extractor
[![Latest Stable Version](https://poser.pugx.org/ngmy/phar-extractor/v)](//packagist.org/packages/ngmy/phar-extractor)
[![Total Downloads](https://poser.pugx.org/ngmy/phar-extractor/downloads)](//packagist.org/packages/ngmy/phar-extractor)
[![Latest Unstable Version](https://poser.pugx.org/ngmy/phar-extractor/v/unstable)](//packagist.org/packages/ngmy/phar-extractor)
[![License](https://poser.pugx.org/ngmy/phar-extractor/license)](//packagist.org/packages/ngmy/phar-extractor)
[![composer.lock](https://poser.pugx.org/ngmy/phar-extractor/composerlock)](//packagist.org/packages/ngmy/phar-extractor)
[![PHP CI](https://github.com/ngmy/phar-extractor/actions/workflows/php.yml/badge.svg)](https://github.com/ngmy/phar-extractor/actions/workflows/php.yml)
[![Coverage Status](https://coveralls.io/repos/github/ngmy/phar-extractor/badge.svg?branch=master)](https://coveralls.io/github/ngmy/phar-extractor?branch=master)
[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat)](https://github.com/phpstan/phpstan)
[![Psalm Coverage](https://shepherd.dev/github/ngmy/phar-extractor/coverage.svg?)](https://shepherd.dev/github/ngmy/phar-extractor)
[![Psalm Level](https://shepherd.dev/github/ngmy/phar-extractor/level.svg?)](https://shepherd.dev/github/ngmy/phar-extractor)

PHAR Extractor is a console command to extract the contents of a PHAR archive.

```console
./phar-extractor.phar extract tools/phpunit
./phar-extractor.phar extract-dir tools
./phar-extractor.phar extract-phive-xml
```

## Requirements
PHAR Extractor has the following requirements:

* PHP >= 7.3

## Installation
### PHAR
Download the PHAR file from the [GitHub Releases page](https://github.com/ngmy/phar-extractor/releases).

### PHIVE
Execute the PHIVE `install` command:
```console
phive install --force-accept-unsigned ngmy/phar-extractor
```

### Composer
Execute the Composer `require` command:
```console
composer require ngmy/phar-extractor
```

## Usage
```console
./phar-extractor.phar help
```

## Documentation
Please see the [API documentation](https://ngmy.github.io/phar-extractor/api/).

## License
PHAR Extractor is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
