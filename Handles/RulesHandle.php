<?php

namespace Transpox\Handles;


class RulesHandle extends AbstractHandle
{
    public function transpose(): resource
    {
        if(empty($this->transposeRulesFile)) {
            throw new \InvalidArgumentException("The transpose rule file cannot be null");
        }
        // TODO: Implement transpose() method.
    }
}