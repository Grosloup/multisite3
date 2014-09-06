<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 31/08/2014
 * Time: 13:08
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

class PostController extends BaseController
{
    public function listAction()
    {
        return $this->render('ZPBAdminBundle:General:post/list.html.twig', []);
    }

    public function createAction(Request $request)
    {
        //TODO
        return $this->render('ZPBAdminBundle:General:post/create.html.twig', []);
    }

    public function updateAction($id, Request $request)
    {
        //TODO
        return $this->render('ZPBAdminBundle:General:post/update.html.twig', []);
    }

    public function deleteAction($id, Request $request)
    {
        //TODO

    }
}
