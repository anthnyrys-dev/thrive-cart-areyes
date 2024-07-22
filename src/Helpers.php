<?php

namespace Kianreyes\ThriveCartAreyes;

class Helpers
{
    /**
     * @param float $total
     * @return string
     */
    public static function format(float $total): string
    {
        return "$" . number_format($total, 2);
    }
}
