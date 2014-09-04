<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 04/09/2014
 * Time: 11:13
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

class MyAccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civilite', 'civility_type', ['label'=>'Civilité','empty_value'=>'------------'])
            ->add('firstname', null, ['label'=>'Prénom*'])
            ->add('lastname', null, ['label'=>'Nom*'])
            ->add('birthdate', 'date', ['label'=>'Date de naissance (jj/mm/aaaa)*','input'=>'datetime','widget'=>'single_text','format'=>'dd/MM/yyyy'])
            ->add('username', null, ['label'=>'pseudo*'])
            ->add('email','email',['label'=>'Adresse email*'])
            ->add('phone',null,['label'=>'Numéro de téléphone*'])
            ->add('address', null,['label'=>'Adresse 1*'])
            ->add('address2', null,['label'=>'Adresse 2'])
            ->add('batiment', null, ['label'=>'Bâtiment'])
            ->add('door', null,['label'=>'Porte'])
            ->add('floor', null, ['label'=>'Etage'])
            ->add('postalCode', null, ['label'=>'Code postal*'])
            ->add('city', null, ['label'=>'Ville*'])
            ->add('country', null, ['label'=>'Pays*'])
            ->add('save', 'submit', ['label'=>'Modifier'])
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\Godparent']);
    }
    
    public function getName()
    {
        return 'godparent_update_form';
    }
}
