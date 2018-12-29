<?php
/**
 * Created by dcaruso.
 * Date: 2018-12-02
 * Time: 14:09
 */

namespace Transpox\Handles;


use Transpox\Resources\ResourcesInterface;

class RulesHandle extends AbstractHandle
{
    /**
     * RulesHandle constructor.
     * @inheritdoc
     * @throws ForceCheckException
     */
    public function __construct(ResourcesInterface $resources, bool $forceCheck = true, bool $includeDestinationHeaders = true)
    {
        parent::__construct($resources, $forceCheck, $includeDestinationHeaders);
        if ($this->resources->getRules() && $this->forceCheck) {
            $this->forceCheck();
        }
    }

    public function transpose()
    {

    }

    /**
     * @throws ForceCheckException
     */
    protected function forceCheck()
    {
        $sources = $this->resources->getRules()->getSources();
        $destinations = $this->resources->getRules()->getDestinations();
        $rules = $this->resources->getRules()->getRules();
        $numberOfSources = count($sources);
        $numberOfDestinations = count($destinations);
        if ($numberOfDestinations > 0 && $numberOfSources > $numberOfDestinations)
        {
            throw new ForceCheckException('The rules file contains more source fields than destinations fields');
        }

        if (!empty($rules)) {
            $ruleDestinations = [];
            foreach ($rules as $ruleName => $ruleTypes) {
                foreach ($ruleTypes as $ruleType) {
                    if (!property_exists($ruleType, 'destinations')) {
                        throw new ForceCheckException('The rule "'.$ruleName.'" has no destinations');
                    }

                    if (!property_exists($ruleType->destinations, 'names') &&
                        !property_exists($ruleType->destinations, 'positions')) {
                        throw new ForceCheckException('The rule "'.$ruleName.'" has no destination names nor positions');
                    }

                    if (property_exists($ruleType->destinations, 'names')) {
                        $ruleDestinations = array_merge($ruleDestinations, $ruleType->destinations->names);
                    } else {
                        $ruleDestinations = array_merge($ruleDestinations, $ruleType->destinations->positions);
                    }
                }
            }
            $redundantDestinations = array_diff_assoc($ruleDestinations, array_unique($ruleDestinations));
            if (!empty($destinations)) {
                $redundantDestinations = array_merge(
                    $redundantDestinations,
                    array_intersect($destinations, $ruleDestinations)
                );
                $redundantDestinations = array_unique($redundantDestinations);
            }
            if ($redundantDestinations) {
                throw new ForceCheckException('The destination/s: "'.implode(', ', $redundantDestinations).'" is/are used more times');
            }
        }
    }
}