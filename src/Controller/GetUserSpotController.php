<?php

namespace App\Controller;

use App\Entity\Spots;
use App\Entity\User;
use App\Repository\SpotsRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;



class GetUserSpotController extends AbstractController
{
    #[Route('/getUser/spot/{id}', name: 'app_get_user_spot')]
    public function index(string $id, SpotsRepository $repo, UserRepository $userRepo, SerializerInterface $serializer): Response
    {

        $result =    $userRepo->findOneBy(['id' => $id]);
     $spotss =    $result->getListSpots();

        $listSpot = [];

     foreach ($spotss as $spot){

         array_push($listSpot,$spot);
     }
        $json = $serializer->serialize($listSpot, 'json',);
          //  dd($json);

        return new Response($json);
    }
}
