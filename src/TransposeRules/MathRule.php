<?php

namespace Transpox\TransposeRules;

class MathRule extends AbstractRule
{
    /** @var string */
    protected $operation;

    public function __construct(array $values, string $operation)
    {
        parent::__construct($values);
        $this->operation = $operation;
    }

    /** @inheritdoc */
    public function getTransposedValue()
    {
        if(empty($this->transposedValue)) {
            $values = $this->values;
            $this->transposedValue = (float)array_shift($values);
            foreach ($values as $value) {
                $this->transposedValue = $this->operate($this->transposedValue, (float)$value, $this->operation);
            }
        }
        return $this->transposedValue;
    }

    /**
     * @param float $firstOperator
     * @param float $secondOperator
     * @param string $operation
     * @return float|int
     */
    protected function operate(float $firstOperator, float $secondOperator, string $operation)
    {
        switch ($operation) {
            case "+":
                return $firstOperator + $secondOperator;
            case "-":
                return $firstOperator - $secondOperator;
            case "*":
                return $firstOperator * $secondOperator;
            case "/":
                return $firstOperator / $secondOperator;
            case "%":
                return $firstOperator % $secondOperator;
            default:
                throw new \InvalidArgumentException('Operation "'.$operation.'" not valid');
        }
    }
}