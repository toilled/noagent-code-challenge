<?php

namespace Basket;

class Offer
{
    private float $discountPercentage;

    public function __construct($discountPercentage)
    {
        $this->discountPercentage = $discountPercentage;
    }

    public function getDiscountPercentage(): float
    {
        return $this->discountPercentage;
    }
}
