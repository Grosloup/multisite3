<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 02/09/2014
 * Time: 00:09
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

namespace ZPB\AdminBundle\Controller\Parrainage;


use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Controller\BaseController;

class SponsoringController extends BaseController
{
    public function listAction()
    {
        //TODO
        return $this->render('ZPBAdminBundle:Parrainage/Sponsoring:list.html.twig', []);
    }

    public function createAction(Request $request)
    {
        //TODO
        return $this->render('ZPBAdminBundle:Parrainage/Sponsoring:create.html.twig', []);
    }

    public function updateAction($id, Request $request)
    {
        //TODO
        return $this->render('ZPBAdminBundle:Parrainage/Sponsoring:update.html.twig', []);
    }

    public function deleteAction($id, Request $request)
    {
        //TODO
        return $this->redirect($this->generateUrl('zpb_admin_sponsor_sponsorings_list'));
    }


}
