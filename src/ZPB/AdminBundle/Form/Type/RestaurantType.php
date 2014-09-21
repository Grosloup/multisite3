<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 21/09/2014
 * Time: 11:31
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

class RestaurantType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,['label'=>'Nom*'])
            ->add('description','textarea',['label'=>'Description*'])
            ->add('mapNum',null,['label'=>'Numéro sur le plan*'])
            ->add('longId', 'hidden')
            ->add('imgId','hidden',['mapped'=>false])
            ->add('save','submit',['label'=>'Enregistrer'])
        ;
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\Restaurant']);
	}

	public function getName()
	{
		return 'resto_form';
	}
}
