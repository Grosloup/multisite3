<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 02/09/14
 * Time: 15:39
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

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnimationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null, ['label'=>'Nom'])
            ->add('description', 'textarea', ['label'=>'Description'])
            ->add('placeNumber', 'text', ['label'=>'Numéro sur le plan'])
            ->add('save', 'submit', ['label'=>'Enregistrer'])
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\Animation']);
    }
    
    public function getName()
    {
        return 'animation_form';
    }
}
