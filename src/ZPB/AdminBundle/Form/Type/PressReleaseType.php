<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 21/09/2014
 * Time: 21:49
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
use ZPB\AdminBundle\Form\DataTransformer\InstitutionTransformer;

class PressReleaseType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $options['em'];
        $institutionTransformer = new InstitutionTransformer($em);
        $builder
            ->add('title',null,['label'=>'Titre'])
            ->add('body',null,['label'=>'Texte'])
            ->add(
                $builder->create(
                    'institution',
                    'entity',
                    [
                        'label'=>'Institution',
                        'class'=>'ZPBAdminBundle:Institution',
                        'data_class'=>'ZPB\AdminBundle\Entity\Institution',
                        'property'=>'name'
                    ]
                )->addModelTransformer($institutionTransformer)
            )
            ->add('imageName','hidden',['mapped'=>false])
            ->add('pdfFr','hidden',[])
            ->add('pdfEn','hidden',[])
            ->add('save','submit',['label'=>'Enregistrer'])
        ;
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\PressRelease']);
        $resolver->setRequired(['em']);
        $resolver->setAllowedTypes(['em'=>'\Doctrine\Common\Persistence\ObjectManager']);
	}

	public function getName()
	{
		return 'press_release_form';
	}
}
