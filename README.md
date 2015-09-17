Doctrine Cache adapter for the Rollerworks Metadata Component
=============================================================

[![Build Status](https://secure.travis-ci.org/rollerworks/%SKEL%.png?branch=master)](http://travis-ci.org/rollerworks/%SKEL%)

This package provides a Doctrine Cache adapter for the [Rollerworks Metadata Component][1].

## Installation

To install this package, add `rollerworks/metadata-doctrine-cache` to your composer.json

```bash
$ php composer.phar require rollerworks/metadata-doctrine-cache
```

Then, you can install the new dependencies by running Composer's `update`
command from the directory where your `composer.json` file is located:

```bash
$ php composer update rollerworks/metadata-doctrine-cache
```

Now, Composer will automatically download all required files, and install them
for you.

## Usage

```php

require 'vendor/autoload.php';

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\ChainCache;
use Doctrine\Common\Cache\FilesystemCache;
use Rollerworks\Component\Metadata\CacheableMetadataFactory;
use Rollerworks\Component\Metadata\Cache\Validator\AlwaysFreshValidator;
use Rollerworks\Component\Metadata\Cache\ArrayCache;

$cacheDirectory = ...;

// The Doctrine cache library.
$doctrineCache = new ChainCache(
    [
        // Include the ArrayCache as the ChainCache will populate all the previous cache layers.
        // So if the `FilesystemCache` has a match it will populate the faster ArrayCache.
        new ArrayCache(),

        // Saves the cache in the filestem.
        new FilesystemCache($cacheDirectory),
    ]
);

// Rollerworks\Component\Metadata\Cache\CacheProvider
$cache = Rollerworks\Component\Metadata\Driver\Cache\DoctrineCache($doctrineCache);

// Rollerworks\Component\Metadata\Driver\MappingDriver
$driver = ...;

// Rollerworks\Component\Metadata\Cache\FreshnessValidator
$freshnessValidator = ...;

$metadataFactory = new CacheableMetadataFactory($driver, $doctrineCache, $freshnessValidator);
```

That's it.

Running test
------------

Whenever you open a pull-request tests are already run by Travis-CI.

Tests can be run with PHPUnit, make sure you use the `--prefer-source`
option when running Composer as some classes for testing are not available
in the archive package.

[1]: https://github.com/rollerworks/rollerworks-metadata
