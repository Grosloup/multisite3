<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 24/11/2014
 * Time: 09:36
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

namespace ZPB\Sites\ZooBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EnglishContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('interlocutor', 'contact_interlocutors_type', ['label'=>'Choisissez votre interlocuteur'])
            ->add('email','email', ['label'=>'Your email'])
            ->add('topic',null, ['label'=>'Subject'])
            ->add('message','textarea', ['label'=>'Your message'])
            ->add('name','text',['label'=>'If you are a human being, let this field blank', 'mapped'=>false])
            ->add('save', 'submit', ['label'=>'Send'])
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\ContactInfo']);
    }
    
    public function getName()
    {
        return 'info_en_zoo_contact_form';
    }
}
