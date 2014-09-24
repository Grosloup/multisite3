<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 24/09/2014
 * Time: 14:35
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

namespace ZPB\Sites\BNBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email','email', ['label'=>'Votre email'])
            ->add('topic',null, ['label'=>'Sujet en quelques mots'])
            ->add('message','textarea', ['label'=>'Sujet en quelques mots'])
            ->add('name','text',['label'=>'Si vous êtes un humain ne remplissez pas ce champs', 'mapped'=>false])
            ->add('save', 'submit', ['label'=>'Envoyer'])
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\ContactInfo']);
    }
    
    public function getName()
    {
        return 'info_bn_contact_form';
    }
}
