<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\WidgetRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DomCrawler\Crawler;
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
 /**
     * @Route("/api/update/{status}/{id}", name="visibilityWidget",  methods={"PUT"})
     */

    public function updateStatusWidget(int $status, int $id,WidgetRepository $WidgetService)
    {
      $WidgetService->  updateStatus( $status,$id);
      $serializer = $this->container->get('serializer');
      $WidgetServiceJson = $serializer->serialize($WidgetService, 'json');
      return new Response($WidgetServiceJson, Response::HTTP_OK, ['content-type' => 'application/json']);   
  
    }
    /**
     * @Route("/api/xml/read", name="xml_readFile",  methods={"GET"})
     */

  public function  loadXmlFile(){
    $document = new \DOMDocument();
    $document->loadXml(file_get_contents('../configEntity.xml'));
    $crawler = new Crawler();
    $crawler->addDocument($document);

foreach ($crawler as $domElement) {

}
return new Response($document->saveXML(), 200, ['Content-Type' => 'text/xml']);

  }
}
