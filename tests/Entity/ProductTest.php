<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductTest extends KernelTestCase
{
    public function testProductProperties(): void
    {
        $product = new Product();


        $product->setName('Laptop');
        $this->assertEquals('Laptop', $product->getName());


        $product->setPrice(1200.99);
        $this->assertEquals(1200.99, $product->getPrice());
    }
}
