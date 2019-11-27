<?php declare(strict_types=1);

namespace Horat1us\Environment\Yii2;

use yii\helpers\Inflector;
use Horat1us\Environment;
use yii\base;

class ConfigureBehavior extends base\Behavior
{
    use Environment\ConfigTrait;

    /**
     * Environment Keys Prefix
     *  Owner short class name or last namespace section will be used when behavior attached
     *      \stdClass => STD_CLASS_
     *      \yii\db\Connection => DB_
     * @var string|null
     */
    public $keyPrefix;

    /**
     * Owner properties list to configure.
     * @var bool[]
     */
    public $properties = [];

    /**
     * Previous owner properties values to revert when behavior detached
     * @var mixed[]
     */
    private $ownerProperties = [];

    /**
     * Was owner key prefix will be used.
     * If true keyPrefix will be reset on detach.
     * @var bool
     */
    private $isOwnerKeyPrefix = true;

    final public function events(): array
    {
        throw new \BadMethodCallException(__METHOD__ . " is not used in " . __CLASS__);
    }

    public function attach($owner): void
    {
        $this->ownerProperties = [];
        if (is_null($this->keyPrefix)) {
            $this->isOwnerKeyPrefix = true;
            $this->setEnvironmentKeyPrefix($owner);
        }

        foreach ($this->properties as $property) {
            $this->ownerProperties[$property] = $defaultProperty = $owner->{$property};
            $owner->{$property} = $this->getEnv(
                mb_strtoupper($property),
                is_null($defaultProperty) ? [$this, 'null'] : $defaultProperty
            );
        }
        $this->owner = $owner;
    }

    public function detach(): void
    {
        if ($this->isOwnerKeyPrefix) {
            $this->keyPrefix = null;
        }
        if ($this->owner) {
            \Yii::configure($this->owner, $this->ownerProperties);
        }
    }

    protected function getEnvironmentKeyPrefix(): string
    {
        return $this->keyPrefix;
    }

    protected function setEnvironmentKeyPrefix(base\Component $component = null): void
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $class = new \ReflectionClass($component);
        $nsp = $class->getNamespaceName();
        if ($nsp !== "") {
            $nsp = mb_substr($nsp, mb_strrpos($nsp, '\\') - mb_strlen($nsp) + 1);
        }
        $this->keyPrefix = mb_strtoupper(Inflector::camel2id($nsp, '_', true)) . '_';
    }
}
