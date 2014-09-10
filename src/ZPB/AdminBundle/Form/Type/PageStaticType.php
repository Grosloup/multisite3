<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 10/09/2014
 * Time: 19:10
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

class PageStaticType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,['label'=>'Nom'])
            ->add('title',null,['label'=>'Titre'])
            ->add('description',null,['label'=>'Description'])
            ->add('owner','entity',['label'=>'Site propriétaire','class'=>'ZPBAdminBundle:PostTarget','property'=>'name', 'multiple'=>false, 'expanded'=>false])
        ;
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\PageStatic']);
	}

	public function getName()
	{
		return 'static_page_form';
	}
}
