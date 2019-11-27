<?php declare(strict_types=1);

namespace Horat1us\Environment\Yii2\Tests;

use yii\base;

class ConfigurableComponent extends base\Component
{
    public $default = 'default';

    public $empty;

    public $configurable;
}
