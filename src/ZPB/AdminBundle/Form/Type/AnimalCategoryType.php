<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 28/09/2014
 * Time: 15:19
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

class AnimalCategoryType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('',null,['label'=>''])
        ;
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(['data_class'=>'']);
	}

	public function getName()
	{
		return '';
	}
}
