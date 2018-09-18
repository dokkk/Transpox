<?php
/**
 * Created by dcaruso.
 * Date: 16.09.18
 * Time: 19:09
 */

namespace Transpox\Tests\Rules\Operations\Math;

use PHPUnit\Framework\TestCase;
use Transpox\Rules\Operations\Math\Modulus;
use Transpox\Rules\Values\Numbers;

class ModulusTest extends TestCase
{
    public function testShouldReturn1WhenValuesAre3And2()
    {
        $values = new Numbers([3, 2, 6]);
        $modulus = new Modulus($values);
        $result = $modulus->getResult();
        $this->assertEquals(1, $result, '3 modulus 2 did not give 1 as result');
    }
}
