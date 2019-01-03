<?php
/**
 * Created by dcaruso.
 * Date: 2018-12-01
 * Time: 17:10
 */

namespace Transpox\Tests\Resources\Source;

use PHPUnit\Framework\TestCase;
use Transpox\Resources\Destination\EmptyOriginFileException;
use Transpox\Resources\Destination\PhpOfficeOrigin;

class PhpOfficeSourceTest extends TestCase
{
    public function testShouldThrowEmptyRulesExceptionIfFileIsEmpty()
    {
        $this->expectException(EmptyOriginFileException::class);
        $fileName = '/Users/dcaruso/projects/Transpox/tests/files/testEmpty.csv';
        $phpOfficeSource = new PhpOfficeOrigin($fileName);
    }

    public function testShouldReturnTrueWhenHeadersAreEmpty()
    {
        $fileName = '/Users/dcaruso/projects/Transpox/tests/files/testEmptyHeaders.csv';
        $phpOfficeSource = new PhpOfficeOrigin($fileName);
        $headers = $phpOfficeSource->getHeaders();
        $this->assertEmpty($headers, 'Header array is not empty as expected');
    }
}
