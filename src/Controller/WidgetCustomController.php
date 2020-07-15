<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\WidgetRepository;
use App\Entity\Widget;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class WidgetCustomController extends AbstractController
{
  protected $entityClass = Widget::class;
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
     * @Route("/api/widgets", name="widget_UpdateAll",  methods={"PUT"})
     */
    public function updateAllWidget(Request $request,WidgetRepository $widgetService){
      $serializer = $this->container->get('serializer');
      $data = json_decode($request->getContent(), true);
      $entityManager = $this->getDoctrine()->getManager();


foreach ($data as $widgets)
{$widget =  $widgetService->find($widgets["id"]);
$widget->setBackgroundColor($widgets["backgroundColor"]);
$widget->setBackgroundSmallWidget($widgets["backgroundSmallWidget"]);
$widget->setColorSmallWidget($widgets["colorSmallWidget"]);
$widget->setFont($widgets["font"]);
$widget->setHeight($widgets["height"]);
$widget->setTextColor($widgets["textColor"]);
$widget->setPositionLeft($widgets["positionLeft"]);
$widget->setPositionRight($widgets["positionRight"]);
$widget->setUpdateAt($widgets["updateAt"]);
$widget->setWidth($widgets["width"]);
$widget->setSize($widgets["size"]);
$entityManager->flush();
}



  return new Response( $request->get('widget'), Response::HTTP_OK, ['content-type' => 'application/json']);   

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
