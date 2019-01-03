<?php
/**
 * Created by dcaruso.
 * Date: 04.11.18
 * Time: 23:00
 */

namespace Transpox\Resources\Destination;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Transpox\Resources\ResourcesInterface;

class PhpOfficeDestination extends AbstractDestination implements DestinationInterface
{
    /**
     * @inheritdoc
     */
    public function addHeaders($headers)
    {

    }

    /**
     * Save the $content in the destination
     * @param Spreadsheet $content
     * @return string
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function save($content)
    {
        if (!is_file($this->fileName)) {
            fopen($this->fileName, ResourcesInterface::FILE_OVERWRITE);
        }
        $this->fileType = IOFactory::identify($this->fileName);
        $writer = IOFactory::createWriter($content, $this->fileType);
        $writer->save($this->fileName);
        return $this->fileName;
    }
}