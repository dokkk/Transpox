<?php
/**
 * Created by dcaruso.
 * Date: 2018-12-01
 * Time: 16:26
 */

namespace Transpox\Tests\Resources\Rules;

use PHPUnit\Framework\TestCase;
use Transpox\Resources\BadJSONException;
use Transpox\Resources\Rules\EmptyRulesException;
use Transpox\Resources\Rules\JSONRules;

class JSONRulesTest extends TestCase
{
    public function testShouldThrowEmptyRulesExceptionIfFileIsEmpty()
    {
        $this->expectException(EmptyRulesException::class);
        $fileName = '/Users/dcaruso/projects/Transpox/tests/files/testEmpty.js';
        $file = fopen($fileName, 'r');
        $jsonRules = new JSONRules($file);
    }

    public function testShouldThrowJsonExceptionIfJSONContentisBad()
    {
        $this->expectException(BadJSONException::class);
        $fileName = '/Users/dcaruso/projects/Transpox/tests/files/testBadJSONContent.js';
        $file = fopen($fileName, 'r');
        $jsonRules = new JSONRules($file);
    }
}
