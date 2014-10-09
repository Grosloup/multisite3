<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 09/10/2014
 * Time: 12:40
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

namespace ZPB\Sites\ZooBundle\Controller\PhotothequeHd;


use ZPB\AdminBundle\Controller\BaseController;

class PhotoHdController extends BaseController
{
    public function indexAction()
    {
        return $this->render('ZPBSitesZooBundle:PhotothequeHd/PhotoHd:index.html.twig', []);
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
        $photos = $this->getRepo('ZPBAdminBundle:PhotoHd')->findBy(['category'=>$category], ['position'=>'ASC']);
        return $this->render('ZPBSitesZooBundle:PhotothequeHd/PhotoHd:show_category.html.twig', ['photos'=>$photos, 'category'=>$category, 'institution'=>$institution]);
    }
}
