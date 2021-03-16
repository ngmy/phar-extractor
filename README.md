# PHAR Extractor
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
