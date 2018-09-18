<?php
/**
 * Created by dcaruso.
 * Date: 16.09.18
 * Time: 12:39
 */

namespace Transpox\Rules\Values;

interface ValueInterface
{
    /**
     * returns the set value
     * @return mixed
     */
    public function get();
}