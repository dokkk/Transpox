<?php
/**
 * Created by dcaruso.
 * Date: 04.11.18
 * Time: 23:00
 */

namespace Transpox\Resources\Destination;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Transpox\Resources\AbstractPhpOfficeFile;

class PhpOfficeDestination extends AbstractPhpOfficeFile implements DestinationInterface
{
    /**
     * @var string $fileName
     */
    protected $fileName;

    /**
     * @var string $fileType
     */
    protected $fileType;

    /**
     * PhpOfficeDestination constructor.
     * @param resource $file
     * @param IOFactory $factory
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function __construct($file, IOFactory $factory)
    {
        parent::__construct($file, $factory);
        $meta_data = stream_get_meta_data($this->file);
        $this->fileName = $meta_data["uri"];
        $this->fileType = $factory::identify($this->fileName);
    }

    /**
     * Save the $content in the destination
     * @param $content
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function save($content)
    {
        $writer = $this->factory::createWriter($content, $this->fileType);
        $writer->save($this->fileName);
    }
}