<?php

namespace App\Security\Voter;

use App\Entity\Recipes;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\Length;

class RecipesVoter extends Voter
{
    const MY_RECIPES = 'my_recipes';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {   
        if (empty($subject)) {
            return false;
        }
        foreach ($subject as $value) {
            if (!$value instanceof Recipes) {
                return false;
            }
        }
        return in_array($attribute, [self::MY_RECIPES]);
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }
        foreach ($subject as $value) {
            if (!($value->getUser() == $user)) {
                return false;
            }
        }
        return true;
    }
}
