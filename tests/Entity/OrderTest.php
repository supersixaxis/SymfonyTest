<?php

namespace App\Tests\Entity;

use App\Entity\Order;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OrderTest extends KernelTestCase
{
    public function testOrderProperties(): void
    {
        $order = new Order();

  
        $order->setNumber('ORD-12345');
        $this->assertEquals('ORD-12345', $order->getNumber());


        $order->setTotalPrice(2500.50);
        $this->assertEquals(2500.50, $order->getTotalPrice());

 
        $user = new User();
        $user->setEmail('test@example.com');
        $order->setUser($user);

 
        $this->assertSame($user, $order->getUser());


        $this->assertEquals('test@example.com', $order->getUser()->getEmail());


      
    }
}
