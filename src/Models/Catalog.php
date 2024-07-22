<?php

namespace Kianreyes\ThriveCartAreyes\Models;

use Kianreyes\ThriveCartAreyes\Interfaces\CatalogInterface;
use Kianreyes\ThriveCartAreyes\Models\Product;

class Catalog implements CatalogInterface
{
    /**
     * @var array
     */
    private array $products = [];

    /**
     * @param Product $product
     * @return void
     */
    public function addProduct(Product $product): void
    {
        $this->products[$product->getCode()] = $product;
    }

    /**
     * @param string $code
     * @return Product|null
     */
    public function getProduct(string $code): ?Product
    {
        return $this->products[$code] ?? null;
    }
}
