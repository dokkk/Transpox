<?php
/**
 * Created by dcaruso.
 * Date: 04.11.18
 * Time: 23:00
 */

namespace Transpox\Resources\Destination;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Transpox\Resources\AbstractFile;

class PhpOfficeDestination extends AbstractFile implements DestinationInterface
{

    /**
     * @var string $fileType
     */
    protected $fileType;

    /**
     * PhpOfficeDestination constructor.
     * @param resource $file
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function __construct($file)
    {
        parent::__construct($file);
        $this->fileType = IOFactory::identify($this->fileName);
    }

    /**
     * Save the $content in the destination
     * @param $content
     * @return string
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function save($content)
    {
        $writer = IOFactory::createWriter($content, $this->fileType);
        $writer->save($this->fileName);
        return $this->fileName;
    }
}