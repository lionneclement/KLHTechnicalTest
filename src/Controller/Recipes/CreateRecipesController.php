<?php

namespace App\Controller\Recipes;

use App\Entity\Recipes;
use Symfony\Component\Security\Core\Security;

class CreateRecipesController
{
    private $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }

    public function __invoke(Recipes $data): Recipes
    {
        if (!$this->user) {
            return false;
        }
        $data->setUser($this->user);

        return $data;
    }
}