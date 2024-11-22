<?php

namespace App\Service;

class Calculator
{
    public function getTotalHT(array $products): float
    {
        $totalHT = 0;

        foreach ($products as $item) {
            $product = $item['product'];
            $quantity = $item['quantity'];
            $totalHT += $product->getPrice() * $quantity;
        }

        return $totalHT;
    }

    public function getTotalTTC(array $products, float $tva): float
    {
        $totalHT = $this->getTotalHT($products);
        $totalTTC = $totalHT * (1 + $tva / 100);

        return $totalTTC;
    }
}
