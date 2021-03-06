<?php
/**
 * Created by dcaruso.
 * Date: 04.11.18
 * Time: 20:15
 */

namespace Transpox\Resources\Destination;

interface DestinationInterface
{
    /**
     * Save the $content in the destination
     * @param $content
     */
    public function save($content);
}