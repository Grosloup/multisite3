<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 13/09/2014
 * Time: 16:54
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

namespace ZPB\Sites\ZooBundle\Controller\Phototheque;


use ZPB\AdminBundle\Controller\BaseController;

class PhotoController extends BaseController
{
    public function indexAction()
    {
        $institutions = $this->getRepo('ZPBAdminBundle:Institution')->findAll();
        return $this->render('ZPBSitesZooBundle:Phototheque/Photo:index.html.twig', ['institutions'=>$institutions]);
    }


    public function showCategoryAction($institutslug, $catslug)
    {
        $category = $this->getRepo('ZPBAdminBundle:PhotoCategory')->findOneBySlug($catslug);
        if(!$category){
            throw $this->createNotFoundException();
        }
        $institution = $this->getRepo('ZPBAdminBundle:Institution')->findOneBySlug($institutslug);
        if(!$institution){
            throw $this->createNotFoundException();
        }
        $photos = $this->getRepo('ZPBAdminBundle:Photo')->findBy(['category'=>$category], ['position'=>'ASC']);
        return $this->render('ZPBSitesZooBundle:Phototheque/Photo:show_category.html.twig', ['photos'=>$photos, 'category'=>$category, 'institution'=>$institution]);
    }
}
