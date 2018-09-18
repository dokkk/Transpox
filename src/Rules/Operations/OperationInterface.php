<?php
/**
 * Created by dcaruso.
 * Date: 15.09.18
 * Time: 19:35
 */

namespace Transpox\Rules\Operations;

interface OperationInterface
{
    /** executes the operation and returns the result */
    public function getResult();

    /** adds a value to the array of values
     * @param $value
     */
    public function addValue($value);
}