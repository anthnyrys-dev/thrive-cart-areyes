<?php

namespace Kianreyes\ThriveCartAreyes\Models;

use Kianreyes\ThriveCartAreyes\Interfaces\OfferInterface;

class Offer implements OfferInterface
{
    /**
     * @var string
     */
    private string $productCode;
    
    /**
     * @var int
     */
    private int $requiredQuantity;
    
    /**
     * @var float
     */
    private float $discount;

    /**
     * @param string $productCode
     * @param integer $requiredQuantity
     * @param float $discount
     */
    public function __construct(
        string $productCode,
        int $requiredQuantity,
        float $discount
    ) {
        $this->productCode = $productCode;
        $this->requiredQuantity = $requiredQuantity;
        $this->discount = $discount;
    }

    /**
     * @param array $items
     * @return float
     */
    public function apply(array $items): float
    {
        $discountAmount = 0;
        $count = 0;

        foreach ($items as $item) {
            if ($item->getCode() === $this->productCode) {
                $count++;
            }
        }

        if ($count >= $this->requiredQuantity) {
            $numberOfDiscounts = intdiv($count, $this->requiredQuantity);
            $discountAmount = $numberOfDiscounts * $this->discount;
        }

        return $discountAmount;
    }
}
