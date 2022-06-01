<?php

namespace App\Controller\Admin;

use App\Entity\Fishes;
use App\Entity\Spots;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SpotsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Spots::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Name'),
            TextField::new('description'),
            DateField::new('dateAdd'),
            NumberField::new('profondeur_min'),
            TextField::new('image'),
            NumberField::new('latitude'),
            NumberField::new('longitude'),
            NumberField::new("superficie"),
            AssociationField::new("list_fish"),
            AssociationField::new("categorie"),
            AssociationField::new("state"),
            AssociationField::new("grounds_list"),
            AssociationField::new("owner"),


        ];
    }

}
