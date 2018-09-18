<?php

namespace Transpox\Rules;

interface RuleInterface
{
    /** @return string */
    public function operate();
}