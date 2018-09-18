<?php
/**
 * Created by dcaruso.
 * Date: 15.09.18
 * Time: 21:43
 */

namespace Transpox\Tests\Rules\Operations\Math;

use PHPUnit\Framework\TestCase;
use Transpox\Rules\Operations\Math\Addition;
use Transpox\Rules\Operations\Math\Product;
use Transpox\Rules\Values\Numbers;

class ProductTest extends TestCase
{
    public function testShouldReturn42WhenValuesAre6And7()
    {
        $values = new Numbers([6, 7]);
        $product = new Product($values);
        $result = $product->getResult();
        $this->assertEquals(42, $result, 'Multiplying 6 x 7 did not give 42 as result');
    }
}
