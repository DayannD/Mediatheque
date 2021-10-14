<?php

namespace App\Tests;

use App\Entity\User;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\Date;

class UserTest extends TestCase
{
    public function testIsTrue(): void
    {       
        $date = new \Datetime();
        $user = new User;
        $user->setEmail('true@test.com')
             ->setPassword('password')
             ->setLastname('trueName')
             ->setBornDate($date);

        $this->assertTrue($user->getEmail() === 'true@test.com');
        $this->assertTrue($user->getPassword() === 'password');
        $this->assertTrue($user->getLastname() === 'trueName');
        $this->assertTrue($user->getBornDate() === $date);
    }

    public function testIsFalse(): void
    {       
        $date = new \Datetime();
        $user = new User;
        $user->setEmail('true@test.com')
             ->setPassword('password')
             ->setLastname('trueName')
             ->setBornDate($date);

        $this->assertFalse($user->getEmail() === 'false@test.com');
        $this->assertFalse($user->getPassword() === 'falsepassword');
        $this->assertFalse($user->getLastname() === 'falsetrueName');
    }

    public function testIsEmpty(): void
    {       
        $date = new \Datetime();
        $user = new User;

        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getPassword());
        $this->assertEmpty($user->getLastname());
        $this->assertEmpty($user->getBornDate());
    }
}
