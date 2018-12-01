<?php
/**
 * Created by dcaruso.
 * Date: 2018-12-01
 * Time: 17:10
 */

namespace Transpox\Tests\Resources\Source;

use PHPUnit\Framework\TestCase;
use Transpox\Resources\Source\EmptySourceException;
use Transpox\Resources\Source\PhpOfficeSource;

class PhpOfficeSourceTest extends TestCase
{
    public function testShouldThrowEmptyRulesExceptionIfFileIsEmpty()
    {
        $this->expectException(EmptySourceException::class);
        $fileName = '/Users/dcaruso/projects/Transpox/tests/files/testEmpty.csv';
        $file = fopen($fileName, 'r');
        $phpOfficeSource = new PhpOfficeSource($file);
    }

    public function testShouldReturnTrueWhenHeadersAreEmpty()
    {
        $fileName = '/Users/dcaruso/projects/Transpox/tests/files/testEmptyHeaders.csv';
        $file = fopen($fileName, 'r');
        $phpOfficeSource = new PhpOfficeSource($file);
        $headers = $phpOfficeSource->getHeaders();
        $this->assertEmpty($headers, 'Header array is empty');
    }
}
