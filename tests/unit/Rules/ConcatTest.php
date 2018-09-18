<?php
/**
 * Created by dcaruso.
 * Date: 18.09.18
 * Time: 20:32
 */

namespace Transpox\Test\Rules;

use PHPUnit\Framework\TestCase;
use Transpox\Rules\Concat;

class ConcatTest extends TestCase
{
    public function testShouldReturnConcatenatedStringWithSpaceInTheMiddle()
    {
        $values = ['Domenico', 'Caruso'];
        $separator = ' ';
        $concat = new Concat($values, $separator);
        $result = $concat->operate();
        $this->assertEquals('Domenico Caruso', $result, 'The expected result is not "Domenico Caruso"');
    }
}
