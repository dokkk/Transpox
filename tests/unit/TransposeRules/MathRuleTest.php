<?php
/**
 * Created by dcaruso.
 * Date: 13.09.18
 * Time: 21:12
 */

namespace TransposeRules;

use Transpox\TransposeRules\MathRule;
use PHPUnit\Framework\TestCase;

class MathRuleTest extends TestCase
{
    public function invalidConstructorArgs()
    {
        return [
            [1, '%$']
        ];
    }

    /**
     * @dataProvider invalidConstructorArgs
     */
    public function setUp()
    {
        $this->calculate = new MathRule();
    }
}
