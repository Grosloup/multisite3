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

class MediaPdfUpdateType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','textarea',['label'=>'Texte de l\'attribut title'])
            ->add('copyright',null,['label'=>'Texte du copyright'])
            ->add('save','submit',['label'=>'Upload'])
        ;
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\MediaPdf']);
	}

	public function getName()
	{
		return 'update_media_pdf_form';
	}
}
