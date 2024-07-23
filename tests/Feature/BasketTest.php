<?php

namespace Kianreyes\ThriveCartAreyes;

use PHPUnit\Framework\TestCase;
use Kianreyes\ThriveCartAreyes\Models\Basket;
use Kianreyes\ThriveCartAreyes\Models\Catalog;
use Kianreyes\ThriveCartAreyes\Models\Offer;
use Kianreyes\ThriveCartAreyes\Models\Product;
use Kianreyes\ThriveCartAreyes\Rules\DeliveryChargeRules;
use PHPUnit\Framework\Attributes\DataProvider;

class BasketTest extends TestCase
{
    /**
     * @var Catalog
     */
    private Catalog $catalog;

    /**
     * @var DeliveryChargeRules
     */
    private DeliveryChargeRules $deliveryChargeRules;
    
    /**
     * @var array
     */
    private array $offers;

    protected function setUp(): void
    {
        $this->catalog = new Catalog();
        $this->catalog->addProduct(new Product('R01', 'Red Widget', 32.95));
        $this->catalog->addProduct(new Product('G01', 'Green Widget', 24.95));
        $this->catalog->addProduct(new Product('B01', 'Blue Widget', 7.95));
        
        $this->deliveryChargeRules = new DeliveryChargeRules([
            50 => 4.95,
            90 => 2.95,
        ]);
        
        $this->offers = [
            new Offer('R01', 2, 0.5 * 32.95),
        ];
    }

    #[DataProvider('basketDataProvider')]
    public function testBasketTotal(array $productCodes, float $expectedTotal)
    {
        $basket = new Basket($this->catalog, $this->deliveryChargeRules, $this->offers);
        foreach ($productCodes as $code) {
            $basket->add($code);
        }

        $this->assertEquals($expectedTotal, $basket->total());
    }

    public static function basketDataProvider(): array
    {
        return [
            [
                ['B01', 'B01', 'R01', 'R01', 'R01'], 98.28,
            ],
            [
                ['R01', 'R01'], 54.38,
            ],
            [
                ['R01', 'G01'], 60.85,
            ],
            [
                ['B01', 'B01', 'R01', 'R01', 'R01'], 98.28,
            ],
        ];
    }
}
