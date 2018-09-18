<?php
/**
 * Created by dcaruso.
 * Date: 16.09.18
 * Time: 12:58
 */

namespace Transpox\Rules\Values;


class Number implements ValueInterface
{
    /**
     * @var float|int
     */
    private $value;

    /**
     * Number constructor.
     * @param float|int $value
     */
    public function __construct($value)
    {
        if (!is_float($value) && !is_int($value)) {
            throw new \InvalidArgumentException('The value must be float or int');
        }
        $this->value = $value;
    }

    /**
     * @return float|int
     */
    public function get()
    {
        return $this->value;
    }
}