# Yii2 Environment Config
[![Latest Stable Version](https://poser.pugx.org/horat1us/yii2-environment-config/v/stable.png)](https://packagist.org/packages/horat1us/yii2-environment-config)
[![Total Downloads](https://poser.pugx.org/horat1us/yii2-environment-config/downloads.png)](https://packagist.org/packages/horat1us/yii2-environment-config)
[![Test & Lint](https://github.com/Horat1us/yii2-environment-config/actions/workflows/php.yml/badge.svg?branch=master)](https://github.com/Horat1us/yii2-environment-config/actions/workflows/php.yml)
[![codecov](https://codecov.io/gh/horat1us/yii2-environment-config/branch/master/graph/badge.svg)](https://codecov.io/gh/horat1us/yii2-environment-config)

Main purpose of this package is to integrate 
[horat1us\environment-config](https://github.com/Horat1us/environment-config)
and [yii\base\Configurable](https://www.yiiframework.com/doc/api/2.0/yii-base-configurable)
interface

Compatibility: tested on PHP 8.4, PHP 8.5

## Installation
```bash
composer require horat1us/yii2-environment-config
```

## Usage
```php
<?php

use Horat1us\Environment;

class Config extends Environment\Yii2\Config {
    // implement your methods (getters) here
}

// using constructor
$config = new Config([
    'keyPrefix' => 'SOME_PREFIX_',
]);

// or using container
\Yii::$container->get(Config::class, [], [
    'keyPrefix' => 'SOME_PREFIX_',
]);

```

## Contributors
- [Alexander <horat1us> Letnikow](mailto:reclamme@gmail.com)

## License
[MIT](./LICENSE)
