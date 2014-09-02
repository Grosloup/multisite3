<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 02/09/2014
 * Time: 21:35
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
use ZPB\AdminBundle\Form\DataTransformer\AnimationTransformer;

class SimpleAnimationScheduleType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $options['em'];
        $animationTransformer = new AnimationTransformer($em);
        $builder
            ->add('timetable')
            ->add(
                $builder->create(
                    'animation',
                    'entity',
                    [
                        'label'=>'Animation',
                        'empty_value'=>'Choisir une animation',
                        'class'=>'ZPBAdminBundle:Animation',
                        'data_class'=>'ZPB\AdminBundle\Entity\Animation',
                        'property'=>'name'
                    ]
                    )->addModelTransformer($animationTransformer))
        ;
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\AnimationSchedule']);
        $resolver->setRequired(['em']);
        $resolver->setAllowedTypes(['em'=>'\Doctrine\Common\Persistence\ObjectManager']);
	}

	public function getName()
	{
		return '';
	}
}
