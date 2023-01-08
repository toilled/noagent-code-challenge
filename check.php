<?php

include "Basket.php";
include "Offer.php";
include "Product.php";

use Basket\Basket;
use Basket\Offer;
use Basket\Product;

$offer = new Offer(20);
$basket = new Basket($offer);
$products = [
    new Product('P001', 'Photography', 200),
    new Product('P002', 'Floorplan', 100),
    new Product('P003', 'Gas Certificate', 83.50),
    new Product('P004', 'EICR Certificate', 51.00),
];
foreach ($products as $product) {
    try {
        $basket->addProduct($product);
        $basket->addProduct($product);
    } catch (Exception $exception) {
        echo $exception->getMessage() . PHP_EOL;
    }
}
echo 'Total is: '.number_format($basket->getTotal(), 2).PHP_EOL;
