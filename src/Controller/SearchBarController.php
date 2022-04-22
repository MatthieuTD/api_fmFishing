<?php

namespace App\Controller;

use App\Entity\Spots;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\SpotsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SearchBarController extends AbstractController
{
    #[Route('/api/search/{name}', name: 'search_bar')]
    public function index(String $name, SpotsRepository $spotsRepository): Response
    {

     $result =    $spotsRepository->findByName($name);

        return new Response(json_encode($result));
    }
}
