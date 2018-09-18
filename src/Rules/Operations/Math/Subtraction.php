<?php
/**
 * Created by dcaruso.
 * Date: 15.09.18
 * Time: 21:34
 */

namespace Transpox\Rules\Operations\Math;

class Subtraction extends AbstractOperation
{
    /** subtract all the values passed as array from the first value and returns the result */
    public function getResult()
    {
        $values = $this->values->getArrayCopy();
        $result = array_shift($values);
        foreach ($values as $value) {
            $result -= $value;
        }
        return $result;
    }
}