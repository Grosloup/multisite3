<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 28/09/2014
 * Time: 21:02
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

class AnimalImageController extends BaseController
{
    public function imagesByAnimalAction($id, Request $request)
    {
        $animal = $this->getRepo('ZPBAdminBundle:Animal')->find($id);
        if(!$animal){
            throw $this->createNotFoundException();
        }

        $hds = $this->getRepo('ZPBAdminBundle:AnimalImageHd')->findByAnimal($animal);
        $fronts = $this->getRepo('ZPBAdminBundle:AnimalImageFront')->findByAnimal($animal);
        $wallpapers = $this->getRepo('ZPBAdminBundle:AnimalImageWallpaper')->findByAnimal($animal);

        return $this->render('ZPBAdminBundle:Parrainage/AnimalImage:images_by_animal.html.twig', ['hds'=>$hds, 'fronts'=>$fronts, 'wallpapers'=>$wallpapers, 'animal'=>$animal]);
    }
}
