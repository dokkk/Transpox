<?php
/**
 * Created by dcaruso.
 * Date: 2018-12-02
 * Time: 14:09
 */

namespace Transpox\Handles;


use Transpox\Resources\ResourcesInterface;
use Transpox\Resources\Rules\JSON\JSONRules;

class RulesHandle extends AbstractHandle
{
    /**
     * RulesHandle constructor.
     * @inheritdoc
     * @throws ForceCheckException
     */
    public function __construct(ResourcesInterface $resources, bool $forceCheck = true, bool $includeTargetsHeaders = true)
    {
        parent::__construct($resources, $forceCheck, $includeTargetsHeaders);
        if ($this->resources->getRules() && $this->forceCheck) {
            $this->forceCheck();
        }
    }

    public function transpose()
    {
        $resources = $this->resources;
        $origin = $resources->getOrigin();
        $destination = $resources->getDestination();

        $sourceIdentifierType = $resources->getRules()->getSourcesIdentifierType();
        $sources = $resources->getRules()->getSources();

        //TO DO add headers to content (create a Content class?)

        if ($sourceIdentifierType == JSONRules::VALUES_NAMES) {
            if ($this->includeTargetsHeaders) {
                $headers =  array_intersect($origin->getHeaders(), $sources);
                $destination->addHeaders($headers);
            }
           foreach ($sources as $source) {
               $targets[] = $source;
           }
        } else {

        }
        //$targets = $this->resources->getRules()->getTargets();
        //$destination->save();
    }

    /**
     * @throws ForceCheckException
     */
    protected function forceCheck()
    {
        $this->checkSourcesAndTargetsConsistency();
        $this->checkRulesConsistency();
    }

    /**
     * @throws ForceCheckException
     */
    protected function checkSourcesAndTargetsConsistency()
    {
        $sources = $this->resources->getRules()->getSources();
        $targets = $this->resources->getRules()->getTargets();
        $numberOfSources = count($sources);
        $numberOfTargets = count($targets);
        if ($numberOfTargets > 0 && $numberOfSources > $numberOfTargets)
        {
            throw new ForceCheckException('The rules file contains more source fields than targets fields');
        }
    }

    /**
     * @throws ForceCheckException
     */
    protected function checkRulesConsistency()
    {
        $rules = $this->resources->getRules()->getRules();
        if (!empty($rules)) {
            $ruleTargets = [];
            foreach ($rules as $ruleName => $ruleTypes) {
                foreach ($ruleTypes as $ruleType) {
                    if (!property_exists($ruleType, 'targets')) {
                        throw new ForceCheckException('The rule "'.$ruleName.'" has no targets');
                    }

                    $ruleTypeTargets = $ruleType->targets;
                    if (!property_exists($ruleTypeTargets, 'names') &&
                        !property_exists($ruleTypeTargets, 'positions')) {
                        throw new ForceCheckException('The rule "'.$ruleName.'" has no target names nor positions');
                    }

                    if (property_exists($ruleTypeTargets, 'names')) {
                        $ruleTargets = array_merge($ruleTargets, $ruleTypeTargets->names);
                    } else {
                        $ruleTargets = array_merge($ruleTargets, $ruleTypeTargets->positions);
                    }
                }
            }
            $redundantTargets = array_diff_assoc($ruleTargets, array_unique($ruleTargets));
            $targets = $this->resources->getRules()->getTargets();
            if (!empty($targets)) {
                $redundantTargets = array_merge(
                    $redundantTargets,
                    array_intersect($targets, $ruleTargets)
                );
                $redundantTargets = array_unique($redundantTargets);
            }
            if ($redundantTargets) {
                throw new ForceCheckException('The target/s: "'.implode(', ', $redundantTargets).'" is/are used more times');
            }
        }
    }
}