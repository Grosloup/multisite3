<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 14/09/2014
 * Time: 01:00
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


use ZPB\AdminBundle\Controller\BaseController;

class PhotoStatsController extends BaseController
{
    public function indexAction()
    {
        $downloadsByMonth = $this->getRepo('ZPBAdminBundle:PhotoStat')->downloadsByMonth();

        $results = [];
        for($i=0; $i<12 ; $i++){
            foreach($downloadsByMonth as $k=>$v){
                $results[$i] = 0;
                if(intval($v['m']) == ($i+1)){
                    $results[$i] = intval($v['nb']);
                }
            }
        }
        return $this->render('ZPBAdminBundle:General/PhotoStats:index.html.twig', ['downloadsByMonth'=>$results]);
    }
}
