<?php

namespace Transpox\Rules;

use Transpox\Rules\Values\Numbers;

abstract class AbstractRule implements RuleInterface
{
    /**
     * @var mixed
     */
    protected $values;

    /**
     * @var mixed
     */
    protected $operatedValue;

    /**
     * AbstractRule constructor.
     * @param $values
     */
    public function __construct($values)
    {
        $this->values = $values;
    }
}