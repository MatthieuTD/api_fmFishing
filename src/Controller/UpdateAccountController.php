<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UpdateAccountController extends AbstractController
{
    #[Route('/update/account', name: 'app_update_account')]
    public function index(UserPasswordHasherInterface $passwordHasher, UserRepository $userRepo, Request $request, EntityManagerInterface $manager): Response
    {
        $dataUser  = $request->getContent();
      $dataUser =   json_decode($dataUser, true);
        $result =    $userRepo->findOneBy(['id' => $dataUser['id']]);
        // hash the password (based on the security.yaml config for the $user class)



        if($passwordHasher->isPasswordValid($result,  $dataUser["password"])){

            if(!empty($dataUser["newPassword"])){
                $newHashPwd = $passwordHasher->hashPassword($result,$dataUser["newPassword"]);
                $result->setPassword($newHashPwd);
            }
            $result->setUsername($dataUser["username"]);
            $result->setEmail($dataUser["email"]);
            $result->setPhone($dataUser["phone"]);

        }else{
            return new Response("badPassword");
        }


        $manager->persist($result);
        $manager->flush();
        return new Response("ok");
    }
}
