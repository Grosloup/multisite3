<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 03/09/14
 * Time: 09:59
 */
  /*
           ____________________
  __      /     ______         \
 {  \ ___/___ /       }         \
  {  /       / #      }          |
   {/ ô ô  ;       __}           |
   /          \__}    /  \       /\
<=(_    __<==/  |    /\___\     |  \
   (_ _(    |   |   |  |   |   /    #
    (_ (_   |   |   |  |   |   |
      (__<  |mm_|mm_|  |mm_|mm_|
*/

namespace ZPB\Sites\ZooBundle\Controller\Parrainage;


use ZPB\AdminBundle\Controller\BaseController;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $animals = $this->getRepo('ZPBAdminBundle:Animal')->findall();
        return $this->render('ZPBSitesZooBundle:Parrainage/Index:index.html.twig', ['animals'=>$animals]);
    }

    public function showAnimalAction($name = "")
    {
        $animal = $this->getRepo('ZPBAdminBundle:Animal')->findOneByCcanonicalLongName();

        if(!$animal){
            //TODO page not found
            throw $this->createNotFoundException();
        }

        return $this->render('ZPBSitesZooBundle:Parrainage/Index:show_animal.html.twig', ['animal'=>$animal]);
    }
} 
