<?php
/**
 * Created by dcaruso.
 * Date: 16.09.18
 * Time: 12:41
 */

namespace Transpox\Test\Rules\Values;

use PHPUnit\Framework\TestCase;
use Transpox\Rules\Values\Number;

class NumberTest extends TestCase
{
    public function testGetShouldReturnNumericValue()
    {
        $number = new Number(3.6);
        $value = $number->get();
        $this->assertTrue(is_numeric($value));
    }
}