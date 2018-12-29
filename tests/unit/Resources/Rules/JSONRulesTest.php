<?php
/**
 * Created by dcaruso.
 * Date: 2018-12-01
 * Time: 16:26
 */

namespace Transpox\Tests\Resources\Rules;

use PHPUnit\Framework\TestCase;
use Transpox\Resources\Rules\EmptyDestinationsException;
use Transpox\Resources\Rules\EmptyRulesException;
use Transpox\Resources\Rules\JSON\EmptyJSONRulesFileException;
use Transpox\Resources\Rules\EmptySourcesException;
use Transpox\Resources\Rules\JSON\JSONRules;
use Transpox\Resources\Rules\JSON\BadJSONException;
use Transpox\Resources\Rules\RedundantDestinationsException;
use Transpox\Resources\Rules\RedundantSourcesException;

class JSONRulesTest extends TestCase
{
    public function testShouldThrowEmptyRulesExceptionIfFileIsEmpty()
    {
        $this->expectException(EmptyJSONRulesFileException::class);
        $fileName = '/Users/dcaruso/projects/Transpox/tests/files/testEmpty.js';
        new JSONRules($fileName);
    }

    public function testShouldThrowJsonExceptionIfJSONContentisBad()
    {
        $this->expectException(BadJSONException::class);
        $fileName = '/Users/dcaruso/projects/Transpox/tests/files/testBadJSONContent.js';
        new JSONRules($fileName);
    }

    public function testShouldThrowExceptionWhenSourcesDoNotHaveNamesNorPositions()
    {
        $this->expectException(EmptySourcesException::class);
        $fileName = '/Users/dcaruso/projects/Transpox/tests/files/testRulesWithEmptySources.json';
        new JSONRules($fileName);
    }

    public function testShouldThrowExceptionWhenSourcesHasBothNamesAndPositions()
    {
        $this->expectException(RedundantSourcesException::class);
        $fileName = '/Users/dcaruso/projects/Transpox/tests/files/testRulesWithRedundantSources.json';
        new JSONRules($fileName);
    }

    public function testShouldThrowExceptionWhenDestinationsDoNotHaveNamesNorPositions()
    {
        $this->expectException(EmptyDestinationsException::class);
        $fileName = '/Users/dcaruso/projects/Transpox/tests/files/testRulesWithEmptyDestinations.json';
        new JSONRules($fileName);
    }

    public function testShouldThrowExceptionWhenDestinationsHasBothNamesAndPositions()
    {
        $this->expectException(RedundantDestinationsException::class);
        $fileName = '/Users/dcaruso/projects/Transpox/tests/files/testRulesWithRedundantDestinations.json';
        new JSONRules($fileName);
    }

    public function testShouldThrowExceptionWhenRulesDoNotHaveRules()
    {
        $this->expectException(EmptyRulesException::class);
        $fileName = '/Users/dcaruso/projects/Transpox/tests/files/testRulesWithEmptyRules.json';
        new JSONRules($fileName);
    }
}
