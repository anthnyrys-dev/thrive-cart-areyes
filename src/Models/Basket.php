<?php

namespace Kianreyes\ThriveCartAreyes\Models;

use Kianreyes\ThriveCartAreyes\Interfaces\CatalogInterface;
use Kianreyes\ThriveCartAreyes\Interfaces\DeliveryChargeRulesInterface;

class Basket
{
    /**
     * @var CatalogInterface
     */
    private CatalogInterface $catalog;

    /**
     * @var DeliveryChargeRulesInterface
     */
    private DeliveryChargeRulesInterface $deliveryChargeRules;

    /**
     * @var array
     */
    private array $offers;

    /**
     * @var array
     */
    private array $items = [];

    /**
     * @param CatalogInterface $catalog
     * @param DeliveryChargeRulesInterface $deliveryChargeRules
     * @param array $offers
     */
    public function __construct(
        CatalogInterface $catalog,
        DeliveryChargeRulesInterface $deliveryChargeRules,
        array $offers = []
    ) {
        $this->catalog = $catalog;
        $this->deliveryChargeRules = $deliveryChargeRules;
        $this->offers = $offers;
    }

    /**
     * @param string $productCode
     * @return void
     */
    public function add(string $productCode): void
    {
        $product = $this->catalog->getProduct($productCode);
        if ($product) {
            $this->items[] = $product;
        }
    }

    public function total(): float
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getPrice();
        }

        foreach ($this->offers as $offer) {
            $total -= $offer->apply($this->items);
        }

        $total += $this->deliveryChargeRules->charge($total);

        return number_format($total, 2);
    }

    /**
     * @return void
     */
    public function clear(): void
    {
        $this->items = [];
    }
}
