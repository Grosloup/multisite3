<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 13/10/2014
 * Time: 09:10
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

class PressKitController extends BaseController
{
    public function listAction()
    {
        $entities = $this->getRepo('ZPBAdminBundle:PressKit')->findAll();

        return $this->render('ZPBAdminBundle:General/PressKit:list.html.twig', ['entities'=>$entities]);
    }

    public function createAction(Request $request)
    {
        return $this->render('ZPBAdminBundle:General/PressKit:create.html.twig', []);
    }

    public function updateAction($id, Request $request)
    {

    }

    public function deleteAction($id,Request $request)
    {

    }
}
