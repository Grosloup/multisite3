<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 01/09/14
 * Time: 14:31
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

class PhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $options['em'];
        $categoryTransformer = new PhotoCategoryTransformer($em);
        $slug = $options['slug'];
        $builder
            ->setAction($options['action'])
            ->add('file', 'file', ['label'=>'Fichier photo'])
            ->add('filename',null, ['label'=>'Nom du fichier'])
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
                        'empty_value'=>'Choisir une catégorie',
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

            ->add('save', 'submit', ['label'=>'Upload'])
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\Photo']);
        $resolver->setRequired(['em', 'slug', 'action']);
        $resolver->setAllowedTypes(['em'=>'\Doctrine\Common\Persistence\ObjectManager']);
    }
    
    public function getName()
    {
        return 'photo_form';
    }
}
