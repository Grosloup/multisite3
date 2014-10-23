<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 22/10/2014
 * Time: 15:24
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

class UpdatePostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text', ['label'=>'Titre de l\'article'])
            ->add('body','textarea', ['label'=>'Corps'])
            ->add('excerpt','textarea', ['label'=>'Extrait'])
            ->add('bandeau', 'hidden')
            ->add('squarreThumb', 'hidden')
            ->add('fbThumb', 'hidden')
            ->add('save', 'submit', ['label'=>'Enregistrer'])

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\Post']);
    }

    public function getName()
    {
        return 'update_post_form';
    }
}
