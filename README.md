# Code Generator

Converts the simple object model into different code outputs, by defining syntax generators and code styles.

## Install

The recommended way to install this library is [through composer](http://getcomposer.org).

```sh
composer require xylemical/code-generator
```

## Usage

```php

use Xylemical\Code\Generator\Generator;

$syntax = ...;   // A syntax generator defined by \Xylemical\Code\Generator\SyntaxInterface.
$styles = [...]; // Styles defined by \Xylemical\Code\Generator\StyleInterface.
$generator = new Generator($syntax, $styles);

$definition = ...; // Any definition from the object model library of \Xylemical\Code.
print $generator->generate($definition);

```

## License

MIT, see LICENSE.
