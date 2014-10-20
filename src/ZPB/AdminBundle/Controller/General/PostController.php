<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 20/10/2014
 * Time: 10:36
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
        return $this->render('ZPBAdminBundle:General/Post:list.html.twig', []);
    }

    public function createAction(Request $request)
    {

    }

    public function updateAction($id, Request $request)
    {

    }

    public function deleteAction($id, Request $request)
    {

    }
}
