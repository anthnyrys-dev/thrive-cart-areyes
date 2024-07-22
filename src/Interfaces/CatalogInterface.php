<?php

namespace Kianreyes\ThriveCartAreyes\Interfaces;

use Kianreyes\ThriveCartAreyes\Models\Product;

interface CatalogInterface
{
    /**
     * @param Product $product
     * @return void
     */
    public function addProduct(Product $product): void;

    /**
     * @param string $code
     * @return Product|null
     */
    public function getProduct(string $code): ?Product;
}
