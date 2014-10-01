<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 01/10/2014
 * Time: 09:26
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

namespace ZPB\Sites\GroupBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Controller\BaseController;

class FAQController extends BaseController
{
    public function indexAction(Request $request)
    {
        $institution = $this->getRepo('ZPBAdminBundle:Institution')->findOneByHost($request->getHost());
        $faqs = $this->getRepo('ZPBAdminBundle:FAQ')->findByInstitution($institution);
        $commune = $this->getRepo('ZPBAdminBundle:Institution')->findOneBySlug('commune');
        $cfaqs = [];
        if($commune){
            $cfaqs = $this->getRepo('ZPBAdminBundle:FAQ')->findByInstitution($commune);
        }

        return $this->render('ZPBSitesGroupBundle:FAQ:index.html.twig', ['faqs'=>$faqs, 'cfaqs'=>$cfaqs]);
    }
} 
