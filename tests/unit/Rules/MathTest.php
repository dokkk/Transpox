<?php
/**
 * Created by dcaruso.
 * Date: 18.09.18
 * Time: 20:44
 */

namespace Transpox\Test\Rules;

use PHPUnit\Framework\TestCase;
use Transpox\Rules\Math;
use Transpox\Rules\Values\Numbers;

class MathTest extends TestCase
{
    public function testShouldThrowExceptionWhenOperationIsNotExisting()
    {
        $this->expectException(\InvalidArgumentException::class);
        $values = new Numbers([2, 3]);
        $operation = '';
        $mathRule = new Math($values, $operation);
    }

    public function testShouldReturn66OnMultiplicationOf33And2()
    {
        $values = new Numbers([33, 2]);
        $multiply = new Math($values, Math::MULTIPLY);
        $result = $multiply->operate();
        $this->assertEquals(66, $result, 'The result is not 66 as expected');
    }

    public function testShouldReturnMinus10WhenSubtracting20From10()
    {
        $values = new Numbers([10, 20]);
        $subtraction= new Math($values, Math::SUBTRACT);
        $result = $subtraction->operate();
        $this->assertEquals(-10, $result, 'The result is not -10 as expected');
    }
}
