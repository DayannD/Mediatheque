<?php

namespace App\Controller\Admin;

use App\Entity\Emprunt;
use App\Entity\Livre;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\BatchActionDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EmpruntCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Emprunt::class;
        
    }

    public function configureFields(string $pageName): iterable
    {

        return [

            IdField::new('id')->hideOnForm(),
            DateTimeField::new('date_emprunt', 'Date demande d\'emprunt')->hideOnForm(),
            TextField::new('email','Name/Email')->hideOnForm(),
            TextField::new('name_livre')->hideOnForm(),
            BooleanField::new('isLoan', 'emprunter'),
            DateTimeField::new('loanAt', 'le'),
            BooleanField::new('isRendering', 'Rendu'),
            DateTimeField::new('renderingAt', 'le'),
        ];
    }
    
    
}
