<?php
/**
 * Created by dcaruso.
 * Date: 04.11.18
 * Time: 20:21
 */

namespace Transpox\Resources\Rules;

interface RulesInterface
{
    /**
     * Return all the rules
     * @return mixed
     */
    public function getAll();
    public function getSources();
    public function getDestinations();
    public function getRules();
}