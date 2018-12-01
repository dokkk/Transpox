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
     * @var boolean $includeDestinationHeaders
     */
    protected $includeDestinationHeaders;

    /**
     * AbstractHandle constructor.
     * if $includeDestinationHeaders is false, the destination is built without headers
     * @param ResourcesInterface $resources
     * @param bool $forceCheck
     * @param bool $includeDestinationHeaders
     */
    public function __construct(ResourcesInterface $resources, bool $forceCheck = true, bool $includeDestinationHeaders = true)
    {
        $this->resources = $resources;
        $this->forceCheck = $forceCheck;
        $this->includeDestinationHeaders = $includeDestinationHeaders;
        $this->validate();
    }

    /**
     * Validate the resources
     */
    protected function validate()
    {
        if ($this->forceCheck) {
            if (empty($this->resources->getRules()->getAll())) {
                throw new \InvalidArgumentException('Rules file cannot be empty');
            }

            if (!empty($this->resources->getSource()) &&
                !empty($this->resources->getDestination())) {

            }

            $sourceHeaders = $this->resources->getSource()->getHeaders();
            if(empty($sourceHeaders)) {
                throw new \InvalidArgumentException("The source file is empty");
            }
        }
    }
}