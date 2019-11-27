<?php declare(strict_types=1);

namespace Horat1us\Environment\Yii2\Tests;

use Horat1us\Environment\Yii2\ConfigureBehavior;
use PHPUnit\Framework\TestCase;

class ConfigureBehaviorTest extends TestCase
{
    public function test(): void
    {
        $component = new ConfigurableComponent();
        putenv('TESTS_CONFIGURABLE=ConfiguredFromEnvironment');

        $behavior = new ConfigureBehavior([
            'properties' => ['default', 'empty', 'configurable'],
        ]);
        $component->attachBehavior('configure', $behavior);

        $this->assertEquals('TESTS_', $behavior->keyPrefix);
        $this->assertEquals($component->default, 'default');
        $this->assertNull($component->empty);
        $this->assertEquals($component->configurable, 'ConfiguredFromEnvironment');

        $component->detachBehavior('configure');
        $this->assertNull($behavior->keyPrefix);
        $this->assertNull($component->configurable);

        $this->expectException(\BadMethodCallException::class);
        $behavior->events();
    }
}
