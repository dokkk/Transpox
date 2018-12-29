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
    protected $headers;
    protected $content;
    protected $fullContent;

    /**
     * PhpOfficeSource constructor.
     * @param string $fileName
     * @throws EmptySourceFileException
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function __construct($fileName)
    {
        parent::__construct($fileName);
        $content = $this->getFileContent();
        if (empty($content)) {
            throw new EmptySourceFileException('The Source file cannot be empty');
        }
        $this->fullContent = $this->readFullContent();
        $this->headers = $this->readHeaders();
        $this->content = $this->readContent();
    }

    /**
     * @return \PhpOffice\PhpSpreadsheet\Spreadsheet
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    protected function readFullContent()
    {
        return IOFactory::load($this->fileName);
    }

    /**
     * @return array
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    protected function readHeaders(): array
    {
        $row = $this->fullContent->getActiveSheet()->getRowIterator(1, 1)->current();
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
     * @return array
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    protected function readContent(): array
    {
        $activeSheet = $this->fullContent->getActiveSheet();
        $rows = [];
        $numberOfRows = $activeSheet->getHighestRow();
        //if only 1 row present, return empty array
        //TO DO check if right or a flag needed to avoid it
        if ($numberOfRows == 1) {
            return $rows;
        }
        $rowIterator = $activeSheet->getRowIterator(1);
        foreach($rowIterator as $row) {
            $cellIterator = $row->getCellIterator();
            $cells = [];
            foreach ($cellIterator as $cell) {
                if(!empty($cell->getValue())) {
                    $cells[] = $cell->getValue();
                }
            }
            $rows[] = $cells;
        }
        return $rows;
    }

    /**
     * @inheritdoc
     */
    public function getHeaders(): array
    {
        return$this->headers;
    }

    /**
     * @inheritdoc
     */
    public function getContent(): array
    {
        return $this->content;
    }

    /**
     * @inheritdoc
     */
    public function getFullContent()
    {
        return $this->fullContent;
    }
}