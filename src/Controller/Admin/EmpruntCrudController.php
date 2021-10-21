<?php

namespace App\Controller\Admin;

use App\Entity\Emprunt;
use App\Entity\Livre;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EmpruntCrudController extends AbstractCrudController
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public static function getEntityFqcn(): string
    {
        return Emprunt::class; 
        return Livre::class;  
    }
    //J'affiche mes données a l'administrateur 
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
    //J'organise les emprunts de façon que les derniers livre emprunter soit les premiers afficher pour l'administrateur
    public function configureCrud(Crud $crud): crud
    {
        if ('isRendering' == false) {
            return $crud

            ->setDefaultSort(['loanAt' => 'DESC']);
        }

        return $crud;
    }

    //Quand l'employé valide la remise du livre , le livre redevien dispo automatiquement
    public function configureActions(Actions $actions): Actions
    {
        $resetBook = Action::new('dispo', 'Remettre le livre en ligne')
            ->linkToCrudAction(Action::EDIT)
            ->displayIf(function($entity) {

                if ($entity->getIsRendering() == true) {

                    $id = $entity->getNameLivre()->getId();

                    $livre = $this->getDoctrine()->getRepository(Livre::class)->find($id);
    
                    $livre->setDispo('1');
    
                    $this->manager->persist($livre);
                    $this->manager->flush();
                    ;
                }
                return ;
            })
        ;

        return $actions
            ->add(Crud::PAGE_INDEX, $resetBook)
        ;
    }

    
    
}
