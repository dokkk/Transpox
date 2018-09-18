<?php

namespace Transpox\Rules;

class Concat extends AbstractRule
{
    /** @var string */
    protected $separator;

    public function __construct(array $values, string $separator = '')
    {
        parent::__construct($values);
        $this->separator = $separator;
    }

    /** @inheritdoc */
    public function operate()
    {
        if(empty($this->operatedValue)) {
            $values = $this->values;
            $this->operatedValue = array_shift($values);
            foreach ($values as $value) {
                $this->operatedValue .= $this->separator.$value;
            }
        }
        return $this->operatedValue;
    }
}