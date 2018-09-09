<?php

namespace Transpox\TransposeRules;

interface RuleInterface
{
    /** @return string */
    public function getTransposedValue();
}