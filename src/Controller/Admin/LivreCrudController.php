<?php

namespace App\Controller\Admin;

use App\Entity\Livre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LivreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Livre::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [

            IdField::new('id'),
            TextField::new('title', 'Titre'),
            TextField::new('auteur', 'Auteur'),
            TextField::new('genre', 'Genre'),
            DateTimeField::new('date_parution', 'Date de parution'),
            ImageField::new('file', 'Image'),
            BooleanField::new('dispo', 'Disponibilité'),

        ];
    }
    
}
