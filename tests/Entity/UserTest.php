<?php

namespace App\Tests\Entity;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    public function testUserProperties(): void
    {
        $user = new User();

  
        $user->setLastname('Doe');
        $this->assertEquals('Doe', $user->getLastname());

  
        $user->setFirstname('John');
        $this->assertEquals('John', $user->getFirstname());

  
        $user->setEmail('john.doe@example.com');
        $this->assertEquals('john.doe@example.com', $user->getEmail());

  
        $user->setPassword('hashed_password');
        $this->assertEquals('hashed_password', $user->getPassword());
        
        $this->assertEquals('john.doe@example.com', $user->getUserIdentifier());
  
        $user->setRoles(['ROLE_USER']);
        $this->assertEquals(['ROLE_USER'], $user->getRoles());

    }
}
