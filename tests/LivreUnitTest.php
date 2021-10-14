<?php

namespace App\Tests;

use App\Entity\Livre;
use PHPUnit\Framework\TestCase;

class LivreUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $date =  new \DateTime();       
        $livre = new Livre();

        $livre->setTitle('title')
              ->setDateParution($date)
              ->setDescription('description')
              ->setFile('file')
              ->setDispo(true);
        
              $this->assertTrue($livre->getTitle() === 'title');
              $this->assertTrue($livre->getDateParution() === $date);
              $this->assertTrue($livre->getDescription() === 'description');
              $this->assertTrue($livre->getFile() === 'file');
              $this->assertTrue($livre->getDispo() === true);
    }

    public function testIsFalse(): void
    {      
        $livre = new Livre();

        $livre->setTitle('title')
              ->setDescription('description')
              ->setFile('file')
              ->setDispo(true);
        
              $this->assertFalse($livre->getTitle() === 'falsetitle');
              $this->assertFalse($livre->getDescription() === 'falsedescription');
              $this->assertFalse($livre->getFile() === 'falsefile');
              $this->assertFalse($livre->getDispo() === false);
    }

    public function testIsEmpty(): void
    {
        $livre = new Livre();
        
              $this->assertEmpty($livre->getTitle());
              $this->assertEmpty($livre->getDescription());
              $this->assertEmpty($livre->getFile());
              $this->assertEmpty($livre->getDispo());
    }
}
