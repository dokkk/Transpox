<?php

namespace Transpox\Rules;

use Transpox\Rules\Operations\Math\Addition;
use Transpox\Rules\Operations\Math\Division;
use Transpox\Rules\Operations\Math\Modulus;
use Transpox\Rules\Operations\Math\Product;
use Transpox\Rules\Operations\Math\Subtraction;
use Transpox\Rules\Values\Numbers;

class Math extends AbstractRule
{
    const ADD = '+';
    const SUBTRACT = '-';
    const MULTIPLY = '*';
    const DIVIDE = '/';
    const MODULUS = '%';

    /**
     * List of all possible math operations
     * @var array
     */
    const OPERATIONS = [
        self::ADD,
        self::SUBTRACT,
        self::MULTIPLY,
        self::DIVIDE,
        self::MODULUS
    ];

    /**
     * @var array
     */
    protected static $operationClasses = [
        self::ADD => Addition::class,
        self::SUBTRACT => Subtraction::class,
        self::MULTIPLY => Product::class,
        self::DIVIDE => Division::class,
        self::MODULUS => Modulus::class
    ];

    /** @var string */
    protected $operation;

    /**
     * Math constructor.
     * @param Numbers $values
     * @param string $operation
     */
    public function __construct($values, string $operation)
    {
        parent::__construct($values);
        $this->checkValues();
        $this->operation = $operation;
        $this->checkOperation();
    }

    /**
     * Check if values are instanceof Numbers
     */
    protected function checkValues()
    {
        if (!$this->values instanceof Numbers) {
            throw new \InvalidArgumentException('$values must be instance of Transpox\Rules\Values\Numbers');
        }
    }

    /**
     * Check if operation is one of the Transpox\Rules\Math::OPERATIONS
     */
    protected function checkOperation()
    {
        if (!in_array($this->operation, self::OPERATIONS)) {
            throw new \InvalidArgumentException('$operation must be a defined one (Transpox\Rules\Math::OPERATIONS)');
        }
    }

    /**
     * execute the operation and return the value
     * @return mixed|string
     */
    public function operate()
    {
        if (!$this->operatedValue) {
            $operationClass = (self::$operationClasses)[$this->operation];
            $operation = new $operationClass($this->values);
            $this->operatedValue = $operation->getResult();
        }
        return $this->operatedValue;
    }
}