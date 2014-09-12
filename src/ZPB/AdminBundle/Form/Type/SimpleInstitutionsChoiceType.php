<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 12/09/2014
 * Time: 12:59
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
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SimpleInstitutionsChoiceType extends AbstractType
{

    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $choices = [];
        $targets = $this->manager->getRepository('ZPBAdminBundle:Institution')->findAll();
        foreach($targets as $target){
            $choices[$target->getId()] = $target->getName();
        }


        $resolver->setDefaults(['label'=>'Choisir une institution', 'choices'=>$choices, 'multiple'=>false, 'expanded'=>false]);
    }
    
    public function getName()
    {
        return 'institution_choice_type';
    }

    public function getParent()
    {
        return 'choice';
    }
}
