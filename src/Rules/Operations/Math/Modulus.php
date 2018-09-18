<?php
/**
 * Created by dcaruso.
 * Date: 15.09.18
 * Time: 21:34
 */

namespace Transpox\Rules\Operations\Math;

class Modulus extends AbstractOperation
{
    /** subtract all the values passed as array from the first value and returns the result */
    public function getResult()
    {
        $values = $this->values->getArrayCopy();
        $result = array_shift($values);
        foreach ($values as $value) {
            $result %= $value;
        }
        return $result;
    }

    protected function checkValues()
    {
        parent::checkValues();
        $values = $this->values->getArrayCopy();
        array_shift($values);
        if (in_array(0, $values)) {
            throw new \InvalidArgumentException('Divisor cannot be 0');
        }
    }
}