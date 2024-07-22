<?php

namespace Kianreyes\ThriveCartAreyes\Interfaces;

interface OfferInterface
{
    /**
     * @param array $items
     * @return float
     */
    public function apply(array $items): float;
}
