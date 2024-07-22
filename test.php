<?php

require 'vendor/autoload.php';

use Kianreyes\ThriveCartAreyes\Helpers;
use Kianreyes\ThriveCartAreyes\Models\Basket;
use Kianreyes\ThriveCartAreyes\Models\Catalog;
use Kianreyes\ThriveCartAreyes\Models\Offer;
use Kianreyes\ThriveCartAreyes\Models\Product;
use Kianreyes\ThriveCartAreyes\Rules\DeliveryChargeRules;

$products = [
    'red' => new Product('R01', 'Red Widget', 32.95),
    'green' => new Product('G01', 'Green Widget', 24.95),
    'blue' => new Product('B01', 'Blue Widget', 7.95),
];
 
// Create product catalog
$catalog = new Catalog();
foreach ($products as $code => $product) {
    $catalog->addProduct($product);
}

// Create delivery charge rules
$deliveryChargeRules = new DeliveryChargeRules([
    50 => 4.95,
    90 => 2.95,
]);

// Create special offers
$offers = [
    new Offer(
        $products['red']->getCode(),
        2,
        0.5 * $products['red']->getPrice()
    ), // Buy one red widget, get the second half price
];

// Create basket and add items
$basket = new Basket($catalog, $deliveryChargeRules, $offers);
$basket->add('B01');
$basket->add('G01');

echo "Products (B01, G01): " . Helpers::format($basket->total()) . "\n";
$basket->clear();

$basket->add('R01');
$basket->add('R01');

echo "Products (R01, R01): " . Helpers::format($basket->total()) . "\n";
$basket->clear();

$basket->add('R01');
$basket->add('G01');

echo "Products (R01, G01): " . Helpers::format($basket->total()) . "\n";
$basket->clear();

$basket->add('B01');
$basket->add('B01');
$basket->add('R01');
$basket->add('R01');
$basket->add('R01');

echo "Products (B01, B01, R01, R01, R01): " . Helpers::format($basket->total()) . "\n";
