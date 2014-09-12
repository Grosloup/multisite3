<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 01/09/14
 * Time: 17:34
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

class PhotoCategoryUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $options['em'];
        $institutionTransformer = new InstitutionTransformer($em);
        $builder
            ->add('name',null, ['label'=>'Nom'])
            ->add('description','textarea',['label'=>'Description'])
            ->add(
                $builder->create(
                    'institution',
                    'entity',
                    [
                        'label'=>'Institution',
                        'empty_value'=>'Choisir une institution',
                        'class'=>'ZPBAdminBundle:Institution',
                        'data_class'=>'ZPB\AdminBundle\Entity\Institution',
                        'property'=>'name'
                    ]
                )->addModelTransformer($institutionTransformer)
            )
            ->add('save', 'submit', ['label'=>'Mettre à jour'])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\PhotoCategory']);
        $resolver->setRequired(['em']);
        $resolver->setAllowedTypes(['em'=>'\Doctrine\Common\Persistence\ObjectManager']);
    }

    public function getName()
    {
        return 'photo_category_update_form';
    }
} 
