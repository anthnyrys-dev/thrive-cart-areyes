<?php

namespace Kianreyes\ThriveCartAreyes;

use PHPUnit\Framework\TestCase;
use Kianreyes\ThriveCartAreyes\Rules\DeliveryChargeRules;

class DeliveryChargeRuleTest extends TestCase
{
    /**
     * @var DeliveryChargeRules
     */
    private DeliveryChargeRules $deliveryChargeRules;

    protected function setUp(): void
    {
        $this->deliveryChargeRules = new DeliveryChargeRules([
            50 => 4.95,
            90 => 2.95,
        ]);
    }

    public function testGetDeliveryCostBelowFifty()
    {
        $this->assertEquals(4.95, $this->deliveryChargeRules->charge(49.99));
    }

    public function testGetDeliveryCostBelowNinety()
    {
        $this->assertEquals(2.95, $this->deliveryChargeRules->charge(89.99));
    }

    public function testGetDeliveryCostNinetyOrAbove()
    {
        $this->assertEquals(0.0, $this->deliveryChargeRules->charge(90));
        $this->assertEquals(0.0, $this->deliveryChargeRules->charge(100));
    }
}
