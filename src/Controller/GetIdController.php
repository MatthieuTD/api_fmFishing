<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetIdController extends AbstractController
{
    #[Route('/get/id/{mail}', name: 'app_get_id')]
    public function index(string $mail, UserRepository $repo): Response
    {

        $result =    $repo->findOneBy(['email' => $mail]);



        return new Response(json_encode($result->getId()));


    }
}
