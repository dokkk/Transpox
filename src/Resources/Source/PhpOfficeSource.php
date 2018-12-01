<?php
/**
 * Created by dcaruso.
 * Date: 04.11.18
 * Time: 23:14
 */

namespace Transpox\Resources\Source;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Transpox\Resources\AbstractPhpOfficeFile;

class PhpOfficeSource extends AbstractPhpOfficeFile implements SourceInterface
{
    protected $sourceSheet;
    protected $sourceHeaders;

    /**
     * PhpOfficeSource constructor.
     * @param resource $file
     * @param IOFactory $factory
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function __construct(resource $file, IOFactory $factory)
    {
        parent::__construct($file, $factory);
        $this->sourceSheet = $this->factory::load($this->file);
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