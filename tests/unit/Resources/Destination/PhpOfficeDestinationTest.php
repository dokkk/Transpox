<?php
/**
 * Created by dcaruso.
 * Date: 2018-12-01
 * Time: 13:55
 */

namespace Transpox\Resources\Destination;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PHPUnit\Framework\TestCase;

class PhpOfficeDestinationTest extends TestCase
{
    public function testShouldFailIfFileIsNotSaved()
    {
        $fileName = '/Users/dcaruso/projects/Transpox/tests/files/PhpOfficeTest1';
        $phpOfficeDestination = new PhpOfficeDestination($fileName);
        $content = new Spreadsheet();
        $savedFile = $phpOfficeDestination->save($content);
        $this->assertFileExists($savedFile, 'The file has not be saved');
    }
}
