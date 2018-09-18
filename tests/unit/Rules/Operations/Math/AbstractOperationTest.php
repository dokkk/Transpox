<?php
/**
 * Created by dcaruso.
 * Date: 16.09.18
 * Time: 03:58
 */

namespace Transpox\Tests\Rules\Operation\Math;

use PHPUnit\Framework\TestCase;
use Transpox\Rules\Values\Numbers;

class AbstractOperationTest extends TestCase
{
    public function testNumberOfValuesShouldBe2AfterAdding1()
    {
        $values = new Numbers([1, 2]);
        $params = ['values' => $values];
        $operation = $this->getMockForAbstractClass('Transpox\Rules\Operations\Math\AbstractOperation', $params);
        $operation->addValue(4);
        $count = count($operation->getValues());
        $this->assertEquals(3, $count, 'Adding a value did not give 3 as count result');
    }
}