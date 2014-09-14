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
        $repo = $this->getRepo('ZPBAdminBundle:PhotoStat');
        $downloadsByMonth = $repo->downloadsByMonth();
        $ranking = $repo->photosRanking();

        $results = [];
        for($i=0; $i<12 ; $i++){
            $results[$i] = 0;
            foreach($downloadsByMonth as $k=>$v){

                if(intval($v['m']) == ($i+1)){
                    $results[$i] = intval($v['nb']);
                }
            }
        }
        $ranking = $repo->photosRanking();
        $rankingNums='';
        $rankingLabels='';
        foreach($ranking as $r){
            $rankingNums .= $r['nb'].',';
            $rankingLabels .= '"' . $r['filename'].'"'.',';
        }
        $rankingNums=rtrim($rankingNums, ',');
        $rankingLabels=rtrim($rankingLabels, ',');

        $hostRanking = $repo->hostsRanking();
        $hostNums = '';
        $hostLabels = '';
        foreach($hostRanking as $r){
            $hostNums .= $r['nb'].',';
            $hostLabels .= '"' . str_replace('.com', '', $r['host']).'"'.',';
        }
        $hostNums=rtrim($hostNums, ',');
        $hostLabels=rtrim($hostLabels, ',');

        return $this->render('ZPBAdminBundle:General/PhotoStats:index.html.twig', ['downloadsByMonth'=>$results,'rkNums'=>$rankingNums, 'rkLabels'=>$rankingLabels, 'hostNums'=>$hostNums, 'hostLabels'=>$hostLabels]);
    }
}
