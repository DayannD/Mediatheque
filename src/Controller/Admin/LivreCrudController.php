<?php

namespace App\Controller\Admin;

use App\Entity\Livre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class LivreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Livre::class;
    }

    //Configuration de la parti livre
    public function configureFields(string $pageName): iterable
    {
        return [

            IdField::new('id')->hideOnForm(),
            TextField::new('title', 'Titre'),
            TextField::new('auteur', 'Auteur'),
            ChoiceField :: new( 'genre' )
                            -> setLabel( " Genre" )
                            -> setChoices([ 
                                        'Policier' => 'Policier',
                                        'Autobiograpique' => 'Autobiographique',
                                        'Amour' => 'Amour',
                                        'fiction' => 'fiction',
                                        'Thriller' => 'Thriller'
                                        ]),
            textField::new('description', 'Description de l\'oeuvre'),     
            DateTimeField::new('date_parution', 'Date de parution'),
            TextField::new('imageFile')->setFormtype(VichImageType::class)->onlyWhenCreating(),
            ImageField::new('file')->setBasePath('/uploads/livres/')->onlyOnIndex(),
            BooleanField::new('dispo', 'Disponibilité'),

        ];
    }    
}
