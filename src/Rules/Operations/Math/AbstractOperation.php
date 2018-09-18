<?php
/**
 * Created by dcaruso.
 * Date: 15.09.18
 * Time: 21:25
 */

namespace Transpox\Rules\Operations\Math;

use Transpox\Rules\Operations\OperationInterface;
use Transpox\Rules\Values\Numbers;

abstract class AbstractOperation implements OperationInterface
{
    /** @var Numbers */
    protected $values;

    /**
     * AbstractOperation constructor.
     * @param Numbers $values
     */
    public function __construct($values)
    {
        $this->values = $values;
        $this->checkValues();
    }

    /**
     * Check $values type and count
     */
    protected function checkValues()
    {
        if ($this->values->count() < 2) {
            throw new \InvalidArgumentException(get_called_class().': the number of $values must be at least 2');
        }

        if (!($this->values instanceof Numbers)) {
            throw new \InvalidArgumentException(get_called_class().': $values must be an instance of Numbers');
        }
    }

    /**
     * @return Numbers
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param Number $value
     */
    public function addValue($value)
    {
        $this->values[] = $value;
    }
}