<?php

namespace App\Tests;

use App\Entity\Genre;
use App\Entity\Livre;
use PHPUnit\Framework\TestCase;

class GenreUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $genre = new Genre();

        $genre->setCategorie('categorie');

        $this->assertTrue($genre->getCategorie() === 'categorie');
    }

    public function testIsFalse(): void
    {
        $genre = new Genre();

        $genre->setCategorie('categorie');

        $this->assertfalse($genre->getCategorie() === 'falsecategorie');
    }

    public function testIsEmpty(): void
    {
        $genre = new Genre();

        $this->assertEmpty($genre->getCategorie());
    }
}
