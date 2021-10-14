<?php

namespace App\Tests;

use App\Entity\Emprunt;
use App\Entity\Livre;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;

class EmpruntUnitTest extends TestCase
{
    public function testIsTrue(): void
    {   
        $date = new DateTime();
        $emprunt = new Emprunt();
        $livre = new Livre();
        $user = new User();

        $emprunt->setEmail($user)
                ->setDateEmprunt($date)
                ->setNameLivre($livre);

        $this->assertTrue($emprunt->getEmail() === $user);
        $this->assertTrue($emprunt->getDateEmprunt() === $date);
        $this->assertTrue($emprunt->getNameLivre() === $livre);
    }

    public function testIsFalse(): void
    {   
        $date = new DateTime();
        $emprunt = new Emprunt();
        $livre = new Livre();
        $user = new User();

        $emprunt->setEmail($user)
                ->setDateEmprunt($date)
                ->setNameLivre($livre);

        $this->assertFalse($emprunt->getEmail() === $livre);
        $this->assertFalse($emprunt->getNameLivre() === $user);
    }

    public function testIsEmpty(): void
    {   
        $emprunt = new Emprunt();

        $this->assertEmpty($emprunt->getEmail());
        $this->assertEmpty($emprunt->getNameLivre());
    }
}
