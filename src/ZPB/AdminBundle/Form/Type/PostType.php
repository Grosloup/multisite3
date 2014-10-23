<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 20/10/2014
 * Time: 15:15
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

namespace ZPB\AdminBundle\Form\type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
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
            ->add('save', 'submit', ['label'=>'Enregistrer le brouillon'])
            ->add('publish', 'submit', ['label'=>'Publier'])
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\Post']);
    }
    
    public function getName()
    {
        return 'new_post_form';
    }
}
