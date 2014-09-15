<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 31/08/2014
 * Time: 13:47
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

class AdminUserController extends BaseController
{
    public function listAction()
    {
        $users = $this->getRepo('ZPBAdminBundle:AdminUser')->findAll();
        return $this->render('ZPBAdminBundle:General/admin_user:list.html.twig', ['users'=>$users]);
    }

    public function updateAction($id, Request $request)
    {

    }

    public function createAction($id, Request $request)
    {

    }

    public function deleteAction($id, Request $request)
    {

    }

    public function myAccountAction()
    {

    }
}
