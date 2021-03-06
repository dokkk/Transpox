<?php
/**
 * Created by dcaruso.
 * Date: 15.09.18
 * Time: 21:34
 */

namespace Transpox\Rules\Operations\Math;

class Product extends AbstractOperation
{
    /** adds all the values passed as array and returns the result */
    public function getResult()
    {
        return array_product($this->values->getArrayCopy());
    }
}