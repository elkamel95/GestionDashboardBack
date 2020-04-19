<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\WidgetRepository;
use Symfony\Component\HttpFoundation\Response;

class WidgetCustomController extends AbstractController
{

   /**
     * @Route("/api/reset/position/all", name="reset_position",  methods={"PUT"})
     */
  public function ResetWidgetPosition( WidgetRepository $WidgetService){
    $WidgetService->resetPosition();
    $serializer = $this->container->get('serializer');
    $WidgetServiceJson = $serializer->serialize($WidgetService, 'json');
    return new Response($WidgetServiceJson, Response::HTTP_OK, ['content-type' => 'application/json']);   


  }
 /**
     * @Route("/api/reset/position/{type}", name="reset_positionByType",  methods={"PUT"})
     */

  public function resetWidgetWithType(int $type,WidgetRepository $WidgetService)
  {
    $WidgetService->  resetPositionByType( $type);
    $serializer = $this->container->get('serializer');
    $WidgetServiceJson = $serializer->serialize($WidgetService, 'json');
    return new Response($WidgetServiceJson, Response::HTTP_OK, ['content-type' => 'application/json']);   

  }
}
