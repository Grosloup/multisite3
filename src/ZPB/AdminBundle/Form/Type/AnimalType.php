<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 05/09/2014
 * Time: 15:43
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
use ZPB\AdminBundle\Form\DataTransformer\AnimalSpeciesTransformer;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $options['em'];
        $animalSpeciesTransformer = new AnimalSpeciesTransformer($em);
        $builder
            ->add('name',null, ['label'=>'Nom'])
            ->add('longName',null, ['label'=>'Nom étendu'])
            ->add('bornAt','date', ['label'=>'Date de naissance', 'widget'=>'single_text', 'format'=>'dd/MM/yyyy'])
            ->add('bornIn',null, ['label'=>'Lieu de naissance'])
            ->add('sex','sexe_type', ['label'=>'Sexe'])
            ->add('shortDescription','textarea', ['label'=>'Description courte'])
            ->add('longDescription','textarea', ['label'=>'Description longue'])
            ->add('history',null, ['label'=>'Histoire'])
            ->add(
                $builder->create(
                    'species',
                    'entity',
                    [
                        'label'=>'Espèce',
                        'empty_value'=>'Choisir une espèce',
                        'class'=>'ZPBAdminBundle:AnimalSpecies',
                        'data_class'=>'ZPB\AdminBundle\Entity\AnimalSpecies',
                        'property'=>'name'
                    ]
                )->addModelTransformer($animalSpeciesTransformer)
            )
            ->add('save', 'submit', ['label'=>'Enregistrer'])
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\Animal']);
        $resolver->setRequired(['em']);
        $resolver->setAllowedTypes(['em'=>'\Doctrine\Common\Persistence\ObjectManager']);
    }
    
    public function getName()
    {
        return '';
    }
}
