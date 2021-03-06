<?php
/**
 * Created by dcaruso.
 * Date: 04.11.18
 * Time: 20:01
 */

namespace Transpox\Resources\Source;

interface SourceInterface
{
    /**
     * Return an array containing the source headers
     * @return array
     */
    public function getHeaders(): array;
}