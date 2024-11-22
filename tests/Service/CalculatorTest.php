<?php

namespace App\Tests\Service;

use App\Entity\Product;
use App\Service\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testGetTotalHT(): void
    {
        $calculator = new Calculator();

        $products = $this->getProducts();


        $expectedTotalHT = 101;
        $this->assertEquals($expectedTotalHT, $calculator->getTotalHT($products));
    }

    public function testGetTotalTTC(): void
    {
        $calculator = new Calculator();

        $products = $this->getProducts();
        $tva = 20; 


        $expectedTotalTTC = 121.19999999999999;
        $this->assertEquals($expectedTotalTTC, $calculator->getTotalTTC($products, $tva));
    }

    private function getProducts(): array
    {
        return [
            [
                'product' => $this->createProduct("Ballon rouge", 10),
                'quantity' => 3,
            ],
            [
                'product' => $this->createProduct("Ballon bleu", 8),
                'quantity' => 2,
            ],
            [
                'product' => $this->createProduct("Ballon jaune", 11),
                'quantity' => 5,
            ],
        ];
    }

    private function createProduct(string $name, float $price): Product
    {
        return (new Product())
            ->setName($name)
            ->setPrice($price);
    }
}
