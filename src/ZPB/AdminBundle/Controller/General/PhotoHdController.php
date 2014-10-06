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
    public function listAction()
    {
        $photos = $this->getRepo('ZPBAdminBundle:PhotoHd')->findAll();

        return $this->render('', []);
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
