<?php
namespace AppBundle\Validator;

use Sulu\Bundle\CommunityBundle\Validator\User\CompletionInterface;
use Sulu\Bundle\SecurityBundle\Entity\User;

class CompletionValidator implements CompletionInterface
{
    /**
     * {@inheritdoc}
     */
    public function validate(User $user, $webspaceKey)
    {
        $contact = $user->getContact();

        if (!$contact
            || !$contact->getFirstName()
            || !$contact->getLastName()
            || !$user->getUsername()
            || !$user->getEmail()
        ) {
            return false;
        }

        return true;
    }
}