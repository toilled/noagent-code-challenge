<?php

include "../src/Basket.php";
include "../src/BasketItem.php";
include "../src/DuplicateItem.php";
include "../src/Offer.php";
include "../src/Product.php";

use PHPUnit\Framework\TestCase;
use src\Basket;
use src\BasketItem;
use src\DuplicateItem;
use src\Offer;
use src\Product;

final class BasketTest extends TestCase
{
    public function testCreateExampleBasket()
    {
        $offer = new Offer(10);
        $this->assertInstanceOf(Offer::class, $offer, 'Offer not created');

        $basket = new Basket($offer);
        $this->assertInstanceOf(Basket::class, $basket, 'Basket not created');
        $this->assertInstanceOf(Offer::class, $basket->getOffer(), 'Basket does not contain offer');

        $products = [
            new Product('P001', 'Photography', 200),
            new Product('P002', 'Floorplan', 100),
            new Product('P003', 'Gas Certificate', 83.50),
            new Product('P004', 'EICR Certificate', 51.00),
        ];
        foreach ($products as $product) {
            $this->assertInstanceOf(BasketItem::class, $product, 'Product not a BasketItem');
            try {
                $basket->addItem($product);
            } catch (Exception $exception) {
                echo $exception->getMessage() . PHP_EOL;
            }
        }
        $this->assertCount(4, $basket->getItems(), 'Product missing from basket');

        $this->assertEquals(391.05, $basket->total(), 'Incorrect basket total');
    }

    public function testNoDuplicateItems()
    {
        $this->expectException(DuplicateItem::class);
        $basket = new Basket();
        $products = [
            new Product('P001', 'Photography', 200),
            new Product('P002', 'Floorplan', 100),
            new Product('P003', 'Gas Certificate', 83.50),
            new Product('P004', 'EICR Certificate', 51.00),
        ];
        foreach ($products as $product) {
            $basket->addItem($product);
        }
        $basket->addItem($products[0]);
    }
}
