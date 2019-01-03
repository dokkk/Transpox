<?php

namespace Transpox\Handles;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Transpox\Resources\ResourcesInterface;

abstract class AbstractHandle implements HandleInterface
{
    /**
     * @var ResourcesInterface $resources
     */
    protected $resources;

    /**
     * @var boolean $forceCheck
     */
    protected $forceCheck;

    /**
     * @var boolean $includeTargetsHeaders
     */
    protected $includeTargetsHeaders;

    /**
     * AbstractHandle constructor.
     * if $includeTargetsHeaders is false, the destination file is built without headers
     * @param ResourcesInterface $resources
     * @param bool $forceCheck
     * @param bool $includeTargetsHeaders
     */
    public function __construct(ResourcesInterface $resources, bool $forceCheck = true, bool $includeTargetsHeaders = true)
    {
        $this->resources = $resources;
        $this->forceCheck = $forceCheck;
        $this->includeTargetsHeaders = $includeTargetsHeaders;
    }
}