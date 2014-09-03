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


use Symfony\Component\HttpFoundation\Request;
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

    public function addSponsoringToBasketAction(Request $request)
    {
        $csrfProv = $this->getCsrf();
        $form = $request->request->get("sponsorship_form", false);
        if(!$form){
            throw $this->createAccessDeniedException();
        }
        $token = empty($form['_token']) ? false : $form['_token'];
        if(!$token || !$csrfProv->isCsrfTokenValid('add_sponsorship', $token)){
            throw $this->createAccessDeniedException();
        }
        $packId = empty($form['pack']) ? false : $form['pack'];
        $animalId = empty($form['animal']) ? false : $form['animal'];
        if(!$packId || !$animalId){
            throw $this->createAccessDeniedException();
        }
        $pack = $this->getRepo('ZPBAdminBundle:SponsoringFormula')->find($packId);
        if(!$pack){
            throw $this->createNotFoundException();
        }
        $animal = $this->getRepo('ZPBAdminBundle:Animal')->find($animalId);
        if(!$animal){
            throw $this->createNotFoundException();
        }
        $sb = $this->container->get('zpb.zoo.sponsor_basket');
        $sb->addItem($pack, $animal);
        return $this->redirect($this->generateUrl('zpb_sites_zoo_parrainages_show_basket'));
    }

    public function showBasketAction()
    {
        $sb = $this->container->get('zpb.zoo.sponsor_basket');
        $items = [];
        if(!$sb->isEmpty()){
            $em = $this->getManager();
            foreach($sb->getItems() as $k=>$v){
                $animalId = $v->getAnimal()->getId();
                $packId = $v->getPack()->getId();
                $animal = $em->find(get_class($v->getAnimal()),$animalId);
                $pack = $em->find(get_class($v->getPack()), $packId);
                $items[$v->getId()] = ["pack"=>$pack, "animal"=>$animal];
            }
        }
        return $this->render('ZPBSitesZooBundle:PArrainage/Index:basket.html.twig', ['packs'=>$items]);
    }

    public function removeSponsoringFromBasket($id)
    {


    }
} 
