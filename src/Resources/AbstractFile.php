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
     * @var resource $file
     */
    protected $file;

    /**
     * @var string $fileName
     */
    protected $fileName;

    /**
     * AbstractDestinationFile constructor.
     * @param resource $file
     */
    public function __construct($file)
    {
        $this->file = $file;
        $meta_data = stream_get_meta_data($this->file);
        $this->fileName = $meta_data["uri"];
    }
}