<?php

namespace App\Controller\Admin;

use App\Entity\TypesGrounds;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TypesGroundsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypesGrounds::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
