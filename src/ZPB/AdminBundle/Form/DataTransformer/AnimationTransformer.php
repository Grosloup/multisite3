<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 02/09/2014
 * Time: 21:46
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

namespace ZPB\AdminBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class AnimationTransformer  implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }
    public function transform($value)
    {
        if($value === null){
            return '';
        }
        return $value->getId();
    }

    public function reverseTransform($value)
    {
        if(!$value){
            return null;
        }
        $category = $this->em->getRepository('ZPBAdminBundle:Animation')->findOneBy(['id'=>$value]);
        if(null === $category){
            throw new TransformationFailedException();
        }
        return $category;
    }
}
