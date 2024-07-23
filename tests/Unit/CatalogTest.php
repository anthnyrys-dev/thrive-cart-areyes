<?php

namespace Kianreyes\ThriveCartAreyes;

use PHPUnit\Framework\TestCase;
use Kianreyes\ThriveCartAreyes\Models\Catalog;
use Kianreyes\ThriveCartAreyes\Models\Product;

class CatalogTest extends TestCase
{
    /**
     * @return void
     */
    public function testAddAndRetrieveProduct(): void
    {
        $catalog = new Catalog();
        $product = new Product('R01', 'Red Widget', 32.95);

        $catalog->addProduct($product);
        $retrievedProduct = $catalog->getProduct('R01');

        $this->assertNotNull($retrievedProduct);
        $this->assertSame('R01', $retrievedProduct->getCode());
        $this->assertSame('Red Widget', $retrievedProduct->getName());
        $this->assertSame(32.95, $retrievedProduct->getPrice());
    }

    /**
     * @return void
     */
    public function testRetrieveNonExistentProduct(): void
    {
        $catalog = new Catalog();
        $product = $catalog->getProduct('R01');

        $this->assertNull($product);
    }
}
