[![Build Status](https://img.shields.io/travis/proj4php/proj4php/master.svg)](https://travis-ci.org/proj4php/proj4php)
[![Latest Stable Version](https://img.shields.io/packagist/dt/proj4php/proj4php.svg)](https://packagist.org/packages/proj4php/proj4php)

# proj4php
PHP-class for proj4
This is a PHP-Class for geographic coordinates transformation using proj4 definitions,
thanks to a translation from Proj4JS. 

## Updated Requirements and Features

To keep up with the relentless pace of PHP versions and best practice, the following
features are being implemented on this package:

* [x] Namespacing.
* [ ] PHP5.4+ syntax (not aiming to be bleeding edge here, just yet)
* [ ] [PSR-2 styling](http://www.php-fig.org/psr/psr-2/)
* [x] [PSR-4 autoloader](http://www.php-fig.org/psr/psr-4/)
* [x] [semver](http://semver.org/) relase numbers to packagist.org
* [x] Full compatibility with [composer](https://getcomposer.org/)
* [ ] Tests to come once the above is implemented.

A [legacy branch php4proj5.2](https://github.com/proj4php/proj4php/tree/proj4php5.2) will be
maintained for older applications that need it.

## Using

```php
// Use a PSR-4 autoloader for the `proj4php` root namespace.
include("vendor/autoload.php");

use proj4php\Proj4php;
use proj4php\Proj;
use proj4php\Point;

// Initialise Proj4
$proj4 = new Proj4php();

// Create two different projections.
$projL93    = new Proj('EPSG:2154', $proj4);
$projWGS84  = new Proj('EPSG:4326', $proj4);

// Create a point.
$pointSrc = new Point(652709.401, 6859290.946, $projL93);
echo "Source: " . $pointSrc->toShortString() . " in L93 <br>";

// Transform the point between datums.
$pointDest = $proj4->transform($projWGS84, $pointSrc);
echo "Conversion: " . $pointDest->toShortString() . " in WGS84<br><br>";

// Source: 652709.401 6859290.946 in L93
// Conversion: 2.3557811127971 48.831938054369 in WGS84
```

There are also ways to define inline projections.

## Developing

Feel free to fork us and submit your changes!
