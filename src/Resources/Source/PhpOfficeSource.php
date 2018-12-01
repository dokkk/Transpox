<?php
/**
 * Created by dcaruso.
 * Date: 04.11.18
 * Time: 23:14
 */

namespace Transpox\Resources\Source;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Transpox\Resources\AbstractFile;

class PhpOfficeSource extends AbstractFile implements SourceInterface
{
    protected $sourceSheet;
    protected $sourceHeaders;

    /**
     * PhpOfficeSource constructor.
     * @param resource $file
     * @throws EmptySourceException
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function __construct($file)
    {
        parent::__construct($file);
        $content = stream_get_contents($file);
        if (empty($content)) {
            throw new EmptySourceException('The Source file cannot be empty');
        }
        $this->sourceSheet = IOFactory::load($this->fileName);
        $this->sourceHeaders = $this->getHeaders();
    }

    /**
     * Return an array containing the source headers
     * @return array
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function getHeaders(): array
    {
        $row = $this->sourceSheet->getActiveSheet()->getRowIterator(1, 1)->current();
        $cellIterator = $row->getCellIterator();
        $headers = [];
        foreach ($cellIterator as $cell) {
            if(!empty($cell->getValue())) {
                $headers[] = $cell->getValue();
            }
        }
        return $headers;
    }
}