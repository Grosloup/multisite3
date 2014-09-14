<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 14/09/2014
 * Time: 14:52
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

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ZPB\AdminBundle\Form\DataTransformer\PhotoCategoryTransformer;

class PhotoUpdateType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $options['em'];
        $categoryTransformer = new PhotoCategoryTransformer($em);
        $slug = $options['slug'];
        $builder


            ->add('title', 'textarea', ['label'=>'Texte de l\'attribut title'])
            ->add('copyright', null, ['label'=>'Texte du copyright'])
            ->add('legend', null, ['label'=>'Légende'])
            ->add('description','textarea', ['label'=>'Description'])
            ->add(
                $builder->create(
                    'category',
                    'entity',
                    [
                        'label'=>'Catégorie',

                        'class'=>'ZPBAdminBundle:PhotoCategory',
                        'data_class'=>'ZPB\AdminBundle\Entity\PhotoCategory',
                        'property'=>'name',
                        'query_builder'=>function(EntityRepository $repo) use($slug){
                            return $repo
                                ->createQueryBuilder('c')
                                ->join('c.institution', 'i')
                                ->where('i.slug=:slug')
                                ->setParameter('slug', $slug);
                        }
                    ]
                )->addModelTransformer($categoryTransformer)
            )

            ->add('save', 'submit', ['label'=>'Enregistrer'])
        ;
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\Photo']);
        $resolver->setRequired(['em', 'slug']);
        $resolver->setAllowedTypes(['em'=>'\Doctrine\Common\Persistence\ObjectManager']);
	}

	public function getName()
	{
		return 'update_photo_form';
	}
}
