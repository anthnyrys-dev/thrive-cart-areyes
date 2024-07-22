<?php

namespace Kianreyes\ThriveCartAreyes\Interfaces;

interface DeliveryChargeRulesInterface
{
    /**
     * @param float $total
     * @return float
     */
    public function charge(float $total): float;
}
