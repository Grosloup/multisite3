<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 06/09/2014
 * Time: 09:40
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

namespace ZPB\AdminBundle\Form\Type;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TargetChoiceType extends AbstractType
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $choices = [];
        $targets = $this->manager->getRepository('ZPBAdminBundle:PostTarget')->findAll();
        foreach($targets as $target){
            $choices[$target->getId()] = $target->getName();
        }


        $resolver->setDefaults(['label'=>'Article à la une de', 'choices'=>$choices, 'multiple'=>true, 'expanded'=>true]);
    }

    public function getParent()
    {
        return 'choice';
    }


    public function getName()
    {
        return 'target_choice_type';
    }
}
