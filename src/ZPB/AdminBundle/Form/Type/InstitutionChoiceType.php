<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 12/09/2014
 * Time: 13:07
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

class InstitutionChoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('institution','institution_choice_type', ['label'=>'Filtrer'])
            ->add('save', 'submit', ['label'=>'Filtrer'])
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {

    }
    
    public function getName()
    {
        return 'institution_filter_form';
    }
}
