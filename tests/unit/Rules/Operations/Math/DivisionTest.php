<?php
/**
 * Created by dcaruso.
 * Date: 16.09.18
 * Time: 03:47
 */

namespace Transpox\Tests\Rules\Operations\Math;

use PHPUnit\Framework\TestCase;
use Transpox\Rules\Operations\Math\Division;
use Transpox\Rules\Operations\Math\Subtraction;
use Transpox\Rules\Values\Numbers;

class DivisionTest extends TestCase
{
    public function testShouldReturn2WhenValuesAre8And4()
    {
        $values = new Numbers([8, 4]);
        $division = new Division($values);
        $result = $division->getResult();
        $this->assertEquals(2, $result, 'Dividing 8 by 4 did not give 2 as result');
    }

    public function testShouldReturn1WhenValuesAre5And2And2Point5()
    {
        $values = new Numbers([5, 2, 2.5]);
        $division = new Division($values);
        $result = $division->getResult();
        $this->assertEquals(1, $result, 'Dividing 5 by 2 and by 2.5 did not give 1 as result');
    }
}
