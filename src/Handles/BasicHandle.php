<?php
/**
 * Created by dcaruso.
 * Date: 2018-12-01
 * Time: 23:50
 */

namespace Transpox\Handles;


class BasicHandle extends AbstractHandle
{
    public function transpose()
    {
        $this->resources->getDestination()->save($this->resources->getSource()->getFullContent());
    }
}