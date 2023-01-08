<?php

namespace Basket;

use Exception;

class Basket
{
    /** @var Offer|null */
    private ?Offer $offer;
    /** @var Product[] */
    private array $products = [];

    public function __construct(Offer $offer = null)
    {
        if ($offer !== null) {
            $this->offer = $offer;
        }
    }

    /**
     * @throws Exception
     */
    public function addProduct(Product $product)
    {
        if (in_array($product, $this->products)) {
            throw new Exception("Product {$product->getCode()} is already in the basket!");
        }
        $this->products[] = $product;
    }

    public function getTotal(): float
    {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->getPrice();
        }

        if (isset($this->offer)) {
            $discountAmount = ($this->offer->getDiscountPercentage() / 100) * $total;
            $total -= $discountAmount;
        }

        return $total;
    }
}
