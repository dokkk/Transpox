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
     * @return string
     */
    public function getSourcesIdentifierType();

    /**
     * @return array
     */
    public function getTargets();

    /**
     * @return string
     */
    public function getTargetsIdentifierType();

    /**
     * @return array
     */
    public function getRules();
}