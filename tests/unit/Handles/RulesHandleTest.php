<?php
/**
 * Created by dcaruso.
 * Date: 2018-12-01
 * Time: 18:37
 */

namespace Transpox\tests\unit\Handles;

use PHPUnit\Framework\TestCase;
use Transpox\Handles\ForceCheckException;
use Transpox\Handles\RulesHandle;
use Transpox\Resources\Destination\PhpOfficeDestination;
use Transpox\Resources\Resources;
use Transpox\Resources\Rules\JSON\JSONRules;
use Transpox\Resources\Destination\PhpOfficeOrigin;

class RulesHandleTest extends TestCase
{
    public function testShouldThrowExceptionWhenSourcesAreMoreThanTargetsAndForceCheckIsTrue()
    {
        $this->expectException(ForceCheckException::class);
        $csvFile = '/Users/dcaruso/projects/Transpox/tests/files/toTransposeWithRules1.csv';
        $xlsFile = '/Users/dcaruso/projects/Transpox/tests/files/createdXlsWithRules1.xls';
        $rulesFile = '/Users/dcaruso/projects/Transpox/tests/files/testRulesSourcesMoreThenTargets.json';
        $source = new PhpOfficeOrigin($csvFile);
        $destination = new PhpOfficeDestination($xlsFile);
        $rules = new JSONRules($rulesFile);
        $resources = new Resources($source, $destination, $rules);
        new RulesHandle($resources);
    }

    public function testShouldThrowExceptionWhenSameTargetIsUsedMoreTimesAndForceCheckIsTrue()
    {
        $this->expectException(ForceCheckException::class);
        $csvFile = '/Users/dcaruso/projects/Transpox/tests/files/toTransposeWithRules1.csv';
        $xlsFile = '/Users/dcaruso/projects/Transpox/tests/files/createdXlsWithRules1.xls';
        $rulesFile = '/Users/dcaruso/projects/Transpox/tests/files/testRulesSameTargetMoreTimes.json';
        $source = new PhpOfficeOrigin($csvFile);
        $destination = new PhpOfficeDestination($xlsFile);
        $rules = new JSONRules($rulesFile);
        $resources = new Resources($source, $destination, $rules);
        new RulesHandle($resources);
    }

    public function testShouldTransposeCsvIntoXlsUsingOnlySourceNames()
    {
        $csvFile = '/Users/dcaruso/projects/Transpox/tests/files/toTransposeWithRules1.csv';
        $xlsFile = '/Users/dcaruso/projects/Transpox/tests/files/createdXlsWithRules1.xls';
        $rulesFile = '/Users/dcaruso/projects/Transpox/tests/files/testRulesOnlySourceNames.json';
        $source = new PhpOfficeOrigin($csvFile);
        $destination = new PhpOfficeDestination($xlsFile);
        $rules = new JSONRules($rulesFile);
        $resource = new Resources($source, $destination, $rules);
        $forceCheck = true;
        $basicHandle = new RulesHandle($resource, $forceCheck);
        $basicHandle->transpose();
        $this->assertFileExists($xlsFile, 'The file has not been created');
    }
}
