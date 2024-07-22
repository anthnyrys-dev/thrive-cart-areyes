<?php

namespace Kianreyes\ThriveCartAreyes\Rules;

use Kianreyes\ThriveCartAreyes\Interfaces\DeliveryChargeRulesInterface;

class DeliveryChargeRules implements DeliveryChargeRulesInterface
{
    /**
     * @var array
     */
    private array $rules;

    /**
     * @param array $rules
     */
    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * @param float $total
     * @return float
     */
    public function charge(float $total): float
    {
        foreach ($this->rules as $amount => $charge) {
            if ($total < $amount) {
                return $charge;
            }
        }

        return 0;
    }
}
