<?php

namespace Horat1us\Environment\Yii2;

use Horat1us\Environment;
use yii\base;

/**
 * Class Config
 * @package Horat1us\Environment\Yii2
 */
abstract class Config extends Environment\Config implements base\Configurable
{
    /** @var string */
    public $keyPrefix = '';

    public function __construct(array $config = [])
    {
        \Yii::configure($this, $config);
        parent::__construct($this->keyPrefix);
    }
}
