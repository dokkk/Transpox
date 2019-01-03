<?php
/**
 * Created by dcaruso.
 * Date: 04.11.18
 * Time: 21:07
 */

namespace Transpox\Resources\Destination;

abstract class AbstractDestination
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
     * AbstractOrigin constructor.
     * @param string $fileName
     */
    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }
}