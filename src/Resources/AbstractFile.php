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
     * AbstractDestinationFile constructor.
     * @param resource $file
     */
    public function __construct($file)
    {
        $this->file = $file;
    }
}