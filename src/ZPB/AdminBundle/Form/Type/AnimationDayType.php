<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 02/09/2014
 * Time: 19:17
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

class AnimationDayType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $options['em'];
        $builder
            ->add('name',null,['label'=>'Nom'])
            ->add('color',null,['label'=>'Couleur'])
            ->add('schedules', 'collection', ['type'=>new SimpleAnimationScheduleType(),'allow_add'=>true,'allow_delete'=>true,'delete_empty'=>true, 'by_reference'=>false, 'options'=>['em'=>$em]])
            ->add('save', 'submit',['label'=>'Enregistrer'])
        ;
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\AnimationDay']);
        $resolver->setRequired(['em']);
        $resolver->setAllowedTypes(['em'=>'\Doctrine\Common\Persistence\ObjectManager']);
	}

	public function getName()
	{
		return 'animation_day_form';
	}
}
