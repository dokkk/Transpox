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
     * @return array
     */
    public function getSources();
    /**
     * @return array
     */
    public function getDestinations();
    /**
     * @return array
     */
    public function getRules();
}