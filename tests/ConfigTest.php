<?php

namespace Horat1us\Environment\Yii2\Tests;

use PHPUnit\Framework\TestCase;
use Horat1us\Environment;

/**
 * Class ConfigTest
 * @package Horat1us\Environment\Yii2\Tests
 */
class ConfigTest extends TestCase
{
    protected const PREFIX = 'TEST_PREFIX_';

    /** @var Environment\Yii2\Config */
    protected $config;

    protected function setUp(): void
    {
        parent::setUp();
        $this->config = new class([
            'keyPrefix' => static::PREFIX,
        ]) extends Environment\Yii2\Config
        {
            public function getEnvironmentKeyPrefixAlias(): string
            {
                return $this->getEnvironmentKeyPrefix();
            }
        };
    }

    public function testPrefix(): void
    {
        $this->assertEquals(static::PREFIX, $this->config->keyPrefix);
        $this->assertEquals(static::PREFIX, $this->config->getEnvironmentKeyPrefixAlias());
    }
}
