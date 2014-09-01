<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 01/09/14
 * Time: 16:51
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

class PhotoCategoryController extends BaseController
{
    public function listAction()
    {
        $photoCategories = $this->getRepo('ZPBAdminBundle:PhotoCategory')->findAll();
        return $this->render('ZPBAdminBundle:General/photo_category:list.html.twig', ['categories'=>$photoCategories]);
    }

    public function createAction(Request $request)
    {
        return $this->render('ZPBAdminBundle:General/photo_category:create.html.twig', []);
    }

    public function updateAction($id, Request $request)
    {
        return $this->render('ZPBAdminBundle:General/photo_category:update.html.twig', []);
    }

    public function deleteAction($id, Request $request)
    {

    }
} 
