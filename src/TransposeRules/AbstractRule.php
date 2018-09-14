<?php

namespace Transpox\TransposeRules;

abstract class AbstractRule implements RuleInterface
{
    /**
     * @var mixed
     */
    protected $values;

    /**
     * @var mixed|null
     */
    protected $params;

    /**
     * @var mixed
     */
    protected $transposedValue;

    /**
     * AbstractRule constructor.
     * @param array $values
     * @param array|null $params
     */
    public function __construct(array $values, array $params = null)
    {
        $this->values = $values;
        $this->params = $params;
    }
}