<?php

namespace App\Controller\admin;

use App\Entity\Anmeldung;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AnmeldungCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Anmeldung::class;
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
