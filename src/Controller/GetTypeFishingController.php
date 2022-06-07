<?php

namespace App\Controller;

use App\Repository\FishesRepository;
use App\Repository\SpotsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GetTypeFishingController extends AbstractController
{
    #[Route('/get/fishing/{type}', name: 'app_get_type_fishing')]
    public function index(string $type,FishesRepository $fishRepo,SerializerInterface $serializer ): Response
    {
        if ($type == "carpe"){
            $spots =   $fishRepo->findOneBy(["id" => 1]);
            $coco =     $spots->getSpotsList();
        }elseif($type == "leurre"){
           /* $listSpot = [];
            $brochet =   $fishRepo->findOneBy(["id" => 2]);
            $perche =   $fishRepo->findOneBy(["id" => 7]);
            $blackBass =   $fishRepo->findOneBy(["id" => 10]);

            array_push($listSpot, $brochet->getSpotsList());
            array_push($listSpot, $perche->getSpotsList());
            array_push($listSpot, $blackBass->getSpotsList());


            $popo = $serializer->serialize($listSpot,"json");
          $array =   json_decode($popo, true);

          foreach ($array[1] as $data){
              array_push($array[0], $data);
          }
            foreach ($array[2] as $data){
                array_push($array[0], $data);
            }

            unset($array[1]);
            unset($array[2]);


           // $array[0] = $array[2];
            //array_push($array[0],$array[2]);




         $coco =   array_unique($array);
*/
            $spots =   $fishRepo->findOneBy(["id" => 2]);
            $coco =     $spots->getSpotsList();
        }






        $json = $serializer->serialize($coco, 'json',);



        return new Response($json);
    }
}
