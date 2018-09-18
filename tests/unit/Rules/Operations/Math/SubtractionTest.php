<?php
/**
 * Created by dcaruso.
 * Date: 16.09.18
 * Time: 03:47
 */

namespace Transpox\Tests\Rules\Operations\Math;

use PHPUnit\Framework\TestCase;
use Transpox\Rules\Operations\Math\Subtraction;
use Transpox\Rules\Values\Numbers;

class SubtractionTest extends TestCase
{
    public function testShouldReturn3WhenValuesAre7And4()
    {
        $values = new Numbers([7, 4]);
        $subtraction = new Subtraction($values);
        $result = $subtraction->getResult();
        $this->assertEquals(3, $result, 'Subtracting 3 from 4 did not give 4 as result');
    }

    public function testShouldReturnMinus1WhenValuesAre5And4And2()
    {
        $values = new Numbers([5, 4, 2]);
        $subtraction = new Subtraction($values);
        $result = $subtraction->getResult();
        $this->assertEquals(-1, $result, 'Subtracting 5 and 2 from 5 did not give -1 as result');
    }
}
