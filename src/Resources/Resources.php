<?php
/**
 * Created by dcaruso.
 * Date: 04.11.18
 * Time: 23:26
 */

namespace Transpox\Resources;

use Transpox\Resources\Destination\DestinationInterface;
use Transpox\Resources\Rules\RulesInterface;
use Transpox\Resources\Destination\OriginInterface;

class Resources implements ResourcesInterface
{
    /**
     * @var OriginInterface $origin
     */
    protected $origin;
    /**
     * @var DestinationInterface $destination
     */
    protected $destination;
    /**
     * @var RulesInterface|null $rules
     */
    protected $rules;

    public function __construct(OriginInterface $origin, DestinationInterface $destination, RulesInterface $rules = null)
    {
        $this->origin = $origin;
        $this->destination = $destination;
        $this->rules = $rules;
    }

    /**
     * @return OriginInterface
     */
    public function getOrigin(): OriginInterface
    {
        return $this->origin;
    }

    /**
     * @return DestinationInterface
     */
    public function getDestination(): DestinationInterface
    {
        return $this->destination;
    }

    /**
     * @return RulesInterface|null
     */
    public function getRules()
    {
        return $this->rules;
    }
}