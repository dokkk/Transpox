<?php
/**
 * Created by dcaruso.
 * Date: 04.11.18
 * Time: 21:07
 */

namespace Transpox\Resources;

abstract class AbstractFile
{
    /**
     * @var string $fileName
     */
    protected $fileName;

    /**
     * AbstractDestinationFile constructor.
     * @param string $fileName
     */
    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    protected function getFileContent()
    {
        $file = fopen($this->fileName, 'r');
        $content = stream_get_contents($file);
        fclose($file);
        return $content;
    }
}