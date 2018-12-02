<?php
/**
 * Created by dcaruso.
 * Date: 2018-12-01
 * Time: 18:37
 */

namespace Transpox\tests\unit\Handles;

use Transpox\Handles\AbstractHandle;
use PHPUnit\Framework\TestCase;
use Transpox\Handles\BasicHandle;
use Transpox\Resources\Destination\PhpOfficeDestination;
use Transpox\Resources\Resources;
use Transpox\Resources\Source\PhpOfficeSource;

class BasicHandleTest extends TestCase
{
    public function testShouldTransposeACsvStraightIntoXls()
    {
        $csvFile = '/Users/dcaruso/projects/Transpox/tests/files/toTranspose1.csv';
        $xlsFile = '/Users/dcaruso/projects/Transpox/tests/files/createdXls1.xls';
        $source = new PhpOfficeSource($csvFile);
        $destination = new PhpOfficeDestination($xlsFile);
        $resource = new Resources($source, $destination);
        $basicHandle = new BasicHandle($resource);
        $basicHandle->transpose();
        $this->assertFileExists($xlsFile, 'The file has not been created');
    }
}
