<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as FOS;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends Controller
{
    /**
     * @FOS\Get("/users/{id}")
     *
     * @return \AppBundle\Entity\User
     */
    public function getAction(User $user)
    {
        return $user;
    }

    /**
     * @FOS\Get("/users")
     *
     * @return \AppBundle\Entity\User[]
     */
    public function listAction()
    {
        return $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();
    }

    /**
     * @FOS\Put("/users/{id}/roles")
     *
     * @FOS\RequestParam(name="roles")
     *
     * @return \AppBundle\Entity\User
     */
    public function setRolesAction(User $theUser, array $roles)
    {
        $currentUser = $this->get('security.token_storage')->getToken()->getUser();

        if (empty($currentUser) || $currentUser->getId() !== $theUser->getId()) {
            throw new HttpException(403, 'You can\'t change another users');
        }

        $theUser->setRoles($roles);

        $manager = $this->getDoctrine()->getManagerForClass(User::class);

        $manager->flush();

        return $theUser;
    }
}