<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 06/10/2014
 * Time: 10:25
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

namespace ZPB\AdminBundle\Controller\General;


use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Controller\BaseController;

class PhotoHdController extends BaseController
{
    public function chooseListAction()
    {
        $institutions = $this->getRepo('ZPBAdminBundle:Institution')->findAll();

        return $this->render('ZPBAdminBundle:General/PhotoHd:choose_list.html.twig', ['institutions'=>$institutions]);
    }

    public function listAction($id)
    {
        $category = $this->getRepo('ZPBAdminBundle:PhotoCategory')->find($id);
        if(!$category){
            throw $this->createNotFoundException();
        }

        $photos = $this->getRepo('ZPBAdminBundle:PhotoHd')->findBy(['category'=>$category], ['position'=>'ASC']);
        return $this->render('ZPBAdminBundle:General/PhotoHd:list.html.twig', ['photos'=>$photos, 'category'=>$category]);
    }

    public function createAction(Request $request)
    {

    }

    public function updateAction($id, Request $request)
    {

    }

    public function deleteAction($id, Request $request)
    {
        //delete_photo_hd
    }
} 
