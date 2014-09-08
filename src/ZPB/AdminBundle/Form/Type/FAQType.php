<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 08/09/2014
 * Time: 17:40
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

class FAQType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question','textarea', ['label'=>'La question'])
            ->add('response','textarea', ['label'=>'La réponse'])
            ->add('save', 'submit', ['label'=>'Enregistrer'])
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\FAQ']);
    }
    
    public function getName()
    {
        return 'faq_form';
    }
}
