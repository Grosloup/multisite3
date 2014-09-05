<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 05/09/2014
 * Time: 15:43
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

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null, ['label'=>'Nom'])
            ->add('longName',null, ['label'=>''])
            ->add('bornAt','date', ['label'=>'Date de naissance', 'widget'=>'single_text', 'format'=>'dd/MM/yyyy'])
            ->add('bornIn',null, ['label'=>'Lieu de naissance'])
            ->add('sex','sexe_type', ['label'=>'Sexe'])
            ->add('',null, ['label'=>''])
            ->add('',null, ['label'=>''])
            ->add('',null, ['label'=>''])
            ->add('',null, ['label'=>''])
            ->add('',null, ['label'=>''])
            ->add('save', 'submit', ['label'=>''])
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\Animal']);
    }
    
    public function getName()
    {
        return '';
    }
}
