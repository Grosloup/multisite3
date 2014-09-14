<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 14/09/2014
 * Time: 23:05
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

class MediaPdfUpdateType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $options['em'];
        $institutionTransformer = new InstitutionTransformer($em);
        $builder
            ->add('title','textarea',['label'=>'Texte de l\'attribut title'])
            ->add('copyright',null,['label'=>'Texte du copyright'])
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
            ->add('save','submit',['label'=>'Upload'])
        ;
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\MediaPdf']);
        $resolver->setRequired(['em']);
        $resolver->setAllowedTypes(['em'=>'\Doctrine\Common\Persistence\ObjectManager']);
	}

	public function getName()
	{
		return 'update_media_pdf_form';
	}
}
