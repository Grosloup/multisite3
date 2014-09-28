<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 28/09/2014
 * Time: 16:19
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


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Controller\BaseController;

class XHRController extends BaseController
{
    public function animalChangeCategoryAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ['error'=>false, 'message'=>'', 'animalId'=>null, 'oldCategoryId'=>null, 'newCategoryId'=>null];
        $animalId = $request->request->get('animalId', false);
        $newCategoryId = $request->request->get('categoryId', false);
        if(!$animalId || !$newCategoryId){
            $response['error'] = true;
            $response['message'] = 'Données manquantes';
        } else {
            $animal = $this->getRepo('ZPBAdminBundle:Animal')->find($animalId);
            if(!$animal){
                $response['error'] = true;
                $response['message'] = 'Animal inconnu';
            } else {
                $newCategory = $this->getRepo('ZPBAdminBundle:AnimalCategory')->find($newCategoryId);
                if(!$newCategory){
                    $response['error'] = true;
                    $response['message'] = 'Catégorie inconnue';
                } else {
                    $oldCategoryId = $animal->getCategory()->getId();
                    $animal->setCategory($newCategory);
                    $this->getManager()->persist($animal);
                    $this->getManager()->flush();
                    $response = ['error'=>false, 'message'=>'Modifications enregistrées', 'animalId'=>$animalId, 'oldCategoryId'=>$oldCategoryId, 'newCategoryId'=>$newCategoryId];

                }
            }
        }

        return new JsonResponse($response);
    }
}
