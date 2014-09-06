<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 06/09/2014
 * Time: 14:53
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
use ZPB\AdminBundle\Form\DataTransformer\PostCategoryTransformer;

class PostType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $categoryTransformer = new PostCategoryTransformer($options['em']);
        $builder
            ->add('title',null,['label'=>'Titre'])
            ->add('body','textarea',['label'=>'Corps de l\'article'])
            ->add('excerpt','textarea',['label'=>'Extrait'])
            ->add($builder->create('category', 'entity',['label'=>'Catégorie','empty_value'=>'Choisir une catégorie', 'class'=>'ZPBAdminBundle:PostCategory', 'data_class'=>'ZPB\AdminBundle\Entity\PostCategory', 'property'=>'name'])->addModelTransformer($categoryTransformer))
            ->add('targets', 'entity', ['label'=>'Sites cibles','class'=>'ZPBAdminBundle:PostTarget','property'=>'name', 'multiple'=>true, 'expanded'=>true])
            ->add('save','submit',['label'=>'Enregistrer'])
            ->add('save_publish','submit',['label'=>'Publier'])
        ;
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\Post']);
        $resolver->setRequired(['em']);
        $resolver->setAllowedTypes(['em'=>'\Doctrine\Common\Persistence\ObjectManager']);
	}

	public function getName()
	{
		return 'post_form';
	}
}
