<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Doctrine\ORM\EntityManager;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'register')]
        public function index(UserPasswordHasherInterface $passwordHasher, Request $request, EntityManagerInterface $manager)
    {
        // ... e.g. get the user data from a registration form


        $user = new User();

       $coco  = $request->getContent();

       $coco = json_decode($coco, true);

        $user->setEmail($coco["email"]);
        $user->setUsername($coco["username"]);
        $user->setPhone(intval($coco["phone"]));
        $user->setTypePeche($coco["typePeche"]);
        $plaintextPassword = $coco["password"];

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);
       // dd($user);

        $manager->persist($user);
        $manager->flush();

        return new Response("ok");
    }

}
