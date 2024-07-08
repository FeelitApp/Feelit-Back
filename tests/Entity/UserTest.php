<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_user_setters_and_getters(): void
    {
        $user = new User();
        $user->setEmail('ada@example.com');
        $user->setUsername('ada');

        $this->assertEquals('ada@example.com', $user->getEmail());
        $this->assertEquals('ada', $user->getUsername());
    }
}