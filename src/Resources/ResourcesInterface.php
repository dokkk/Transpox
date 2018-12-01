<?php
/**
 * Created by dcaruso.
 * Date: 04.11.18
 * Time: 19:43
 */

namespace Transpox\Resources;

use Transpox\Resources\Destination\DestinationInterface;
use Transpox\Resources\Rules\RulesInterface;
use Transpox\Resources\Source\SourceInterface;

interface ResourcesInterface
{
    /**
     * @return SourceInterface
     */
    public function getSource(): SourceInterface;

    /**
     * @return DestinationInterface
     */
    public function getDestination(): DestinationInterface;

    /**
     * @return RulesInterface
     */
    public function getRules(): RulesInterface;
}