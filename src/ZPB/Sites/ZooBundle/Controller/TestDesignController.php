<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 15/09/2014
 * Time: 17:05
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

namespace ZPB\Sites\ZooBundle\Controller;


use Facebook\FacebookRequest;
use Facebook\FacebookSession;
use Facebook\GraphUserPage;
use ZPB\AdminBundle\Controller\BaseController;

class TestDesignController extends BaseController
{
    public function indexAction()
    {

        return $this->render('ZPBSitesZooBundle:TestDesign:index.html.twig', []);
    }
} 
