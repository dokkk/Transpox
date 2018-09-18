<?php
/**
 * Created by dcaruso.
 * Date: 15.09.18
 * Time: 21:43
 */

namespace Transpox\Tests\Rules\Operations\Math;

use PHPUnit\Framework\TestCase;
use Transpox\Rules\Operations\Math\Addition;
use Transpox\Rules\Values\Numbers;

class AdditionTest extends TestCase
{
    public function testShouldReturn7WhenValuesAre5And2()
    {
        $values = new Numbers([5, 2]);
        $addition = new Addition($values);
        $result = $addition->getResult();
        $this->assertEquals(7, $result, 'Adding 5 to 2 did not give 7 as result');
    }
}
