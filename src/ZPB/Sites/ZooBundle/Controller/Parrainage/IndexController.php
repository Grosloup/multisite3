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
        $animal = $this->getRepo('ZPBAdminBundle:Animal')->findOneByCanonicalLongName($name);

        if(!$animal){
            //TODO page not found
            throw $this->createNotFoundException();
        }
        $formulas = $this->getRepo('ZPBAdminBundle:SponsoringFormula')->findByIsActive(true);
        $gifts = $this->getRepo('ZPBAdminBundle:SponsoringGiftDefinition')->findAll();

        return $this->render('ZPBSitesZooBundle:Parrainage/Index:show_animal.html.twig', ['animal'=>$animal, 'formulas'=>$formulas, 'gifts'=>$gifts]);
    }
} 
