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
    const FILE_READ = 'w';

    const FILE_OVERWRITE = 'w';

    const FILE_APPEND = 'a';
    /**
     * @return SourceInterface
     */
    public function getSource(): SourceInterface;

    /**
     * @return DestinationInterface
     */
    public function getDestination(): DestinationInterface;

    /**
     * @return RulesInterface|null
     */
    public function getRules();
}