<?php
/**
 * Created by dcaruso.
 * Date: 04.11.18
 * Time: 23:26
 */

namespace Transpox\Resources;

use Transpox\Resources\Destination\DestinationInterface;
use Transpox\Resources\Rules\RulesInterface;
use Transpox\Resources\Source\SourceInterface;

class Resources implements ResourcesInterface
{
    /**
     * @var SourceInterface $source
     */
    protected $source;
    /**
     * @var DestinationInterface $destination
     */
    protected $destination;
    /**
     * @var RulesInterface $rules
     */
    protected $rules;

    public function __construct(SourceInterface $source, DestinationInterface $destination, RulesInterface $rules)
    {
        $this->source = $source;
        $this->destination = $destination;
        $this->rules = $rules;
    }

    /**
     * @return SourceInterface
     */
    public function getSource(): SourceInterface
    {
        return $this->source;
    }

    /**
     * @return DestinationInterface
     */
    public function getDestination(): DestinationInterface
    {
        return $this->destination;
    }

    /**
     * @return RulesInterface
     */
    public function getRules(): RulesInterface
    {
        return $this->rules;
    }
}