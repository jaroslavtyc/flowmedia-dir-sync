<?php declare(strict_types=1);

namespace JaroslavTyc\DirSync;

abstract class StrictObject
{
    /**
     * @param string $name
     * @throws \LogicException
     * @link http://php.net/manual/en/language.oop5.overloading.php#object.get
     */
    public function __get(string $name)
    {
        $reason = 'Does not exist';
        if (property_exists($this, $name)) {
            $reason = 'Has restricted access';
            if ((new \ReflectionProperty($this, $name))->isProtected()) {
                $reason .= ' (is protected)';
            } else {
                $reason .= ' (is private)';
            }
        }
        throw new \LogicException(
            \sprintf('Reading of property [%s->%s] fails. %s.', \get_class($this), $name, $reason)
        );
    }

    /** @noinspection MagicMethodsValidityInspection */
    /**
     * @param string $name
     * @param $value
     * @throws \LogicException
     * @link http://php.net/manual/en/language.oop5.overloading.php#object.set
     */
    public function __set(string $name, $value)
    {
        $reason = 'Does not exist';
        if (property_exists($this, $name)) {
            $reason = 'Has restricted access';
            if ((new \ReflectionProperty($this, $name))->isProtected()) {
                $reason .= ' (is protected)';
            } else {
                $reason .= ' (is private)';
            }
        }
        throw new \LogicException(
            \sprintf('Writing to property [%s->%s] fails. %s.', \get_class($this), $name, $reason)
        );
    }

    /**
     * @param string $name
     * @throws \LogicException
     * @link http://php.net/manual/en/language.oop5.overloading.php#object.unset
     */
    public function __unset(string $name)
    {
        $reason = 'Does not exist';
        if (property_exists($this, $name)) {
            $reason = 'has restricted access';
            if ((new \ReflectionProperty($this, $name))->isProtected()) {
                $reason .= ' (is protected)';
            } else {
                $reason .= ' (is private)';
            }
        }
        throw new \LogicException(
            \sprintf('Unset of property [%s->%s] fails. %s.', \get_class($this), $name, $reason)
        );
    }

    /**
     * @param string $name
     * @param array $arguments
     * @throws \LogicException
     * @link http://php.net/manual/en/language.oop5.overloading.php#object.call
     */
    public function __call(string $name, array $arguments)
    {
        $reason = 'does not exist';
        if (method_exists($this, $name)) {
            $reason = 'has restricted access';
            if ((new \ReflectionMethod($this, $name))->isProtected()) {
                $reason .= ' (is protected)';
            } else {
                $reason .= ' (is private)';
            }
        }
        throw new \LogicException(\sprintf('Method [%s->%s()] %s.', \get_class($this), $name, $reason));
    }

    /**
     * @param string $name
     * @param array $arguments
     * @throws \LogicException
     * @link http://php.net/manual/en/language.oop5.overloading.php#object.callstatic
     */
    public static function __callStatic(string $name, array $arguments)
    {
        $reason = 'does not exist';
        if (method_exists(static::class, $name)) {
            $reason = 'has restricted access';
            if ((new \ReflectionMethod(static::class, $name))->isProtected()) {
                $reason .= ' (is protected)';
            } else {
                $reason .= ' (is private)';
            }
        }
        throw new \LogicException(
            \sprintf('Static method [%s::%s()] %s.', static::class, $name, $reason)
        );
    }

    /**
     * @throws \LogicException
     * @link http://php.net/manual/en/language.oop5.magic.php#object.invoke
     */
    public function __invoke()
    {
        throw new \LogicException(
            \sprintf(
                'Calling object of class [%s] as a function fails. It does not implement the __invoke() method.',
                static::class
            )
        );
    }
}
