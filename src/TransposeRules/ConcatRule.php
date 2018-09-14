<?php

namespace Transpox\TransposeRules;

class ConcatRule extends AbstractRule
{
    /** @var string */
    protected $separator;

    public function __construct(array $values, string $separator)
    {
        parent::__construct($values);
        $this->separator = $separator;
    }

    /** @inheritdoc */
    public function getTransposedValue()
    {
        if(empty($this->transposedValue)) {
            $values = $this->values;
            $this->transposedValue = array_shift($values);
            foreach ($values as $value) {
                $this->transposedValue .= $this->separator.$value;
            }
        }
        return $this->transposedValue;
    }
}