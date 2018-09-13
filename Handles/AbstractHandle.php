<?php

namespace Transpox\Handles;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

abstract class AbstractHandle implements HandleInterface
{
    /**
     * @var resource $sourceFile
     */
    protected $sourceFile;

    /**
     * @var resource $destinationFile
     */
    protected $destinationFile;

    /**
     * @var resource $transposeRulesFile
     */
    protected $transposeRulesFile;

    /**
     * @var bool $forceCheck
     */
    protected $forceCheck;

    /**
     * @var IOFactory $loaderFactory
     */
    protected $loaderFactory;

    /**
     * @var Spreadsheet $sourceSheet
     */
    protected $sourceSheet;

    /**
     * @var array $sourceHeaders
     */
    protected $sourceHeaders;

    /**
     * @var Spreadsheet $destinationSheet
     */
    protected $destinationSheet;

    /**
     * AbstractHandle constructor.
     * @param resource $sourceFile
     * @param resource $destinationFile
     * @param bool $forceCheck
     * @param IOFactory $loaderFactory
     * @param resource|null $transposeRulesFile
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function __construct(resource $sourceFile, resource $destinationFile, bool $forceCheck = true, IOFactory $loaderFactory, resource $transposeRulesFile = null)
    {
        $this->sourceFile = $sourceFile;
        $this->sourceSheet = $this->loaderFactory::load($this->sourceFile);
        $this->sourceHeaders = $this->getHeaders($this->sourceSheet->getActiveSheet());
        if(empty($this->sourceHeaders) && $forceCheck) {
            throw new \InvalidArgumentException("The source file is empty");
        }
        $this->destinationFile = $destinationFile;
        $this->forceCheck = $forceCheck;
        $this->loaderFactory = $loaderFactory;
        $this->transposeRulesFile = $transposeRulesFile;
    }

    /**
     * @param Worksheet $worksheet
     * @return array
     */
    protected function getHeaders(Worksheet $worksheet)
    {
        $row = $worksheet->getRowIterator(1, 1)->current();
        $cellIterator = $row->getCellIterator();
        $headers = [];
        foreach ($cellIterator as $cell) {
            if(!empty($cell->getValue())) {
                $headers[] = $cell->getValue();
            }
        }
        return $headers;
    }

    /**
     * @return \PhpOffice\PhpSpreadsheet\Writer\IWriter
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    protected function getDestinationWriter()
    {
        $meta_data = stream_get_meta_data($this->destinationFile);
        $filename = $meta_data["uri"];
        $filetype = IOFactory::identify($filename);
        return IOFactory::createWriter($this->sourceSheet, $filetype);
    }

}