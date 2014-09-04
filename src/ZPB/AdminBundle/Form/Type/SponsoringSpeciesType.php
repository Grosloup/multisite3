<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 04/09/2014
 * Time: 17:06
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

class SponsoringSpeciesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null, ['label'=>'Nom commun'])
            ->add('longName',null, ['label'=>'Nom étendu'])
            ->add('habitat','textarea', ['label'=>'Habitat'])
            ->add('geoDistribution','textarea', ['label'=>'Distribution géographique'])
            ->add('diet',null, ['label'=>'Régime alimentaire'])
            ->add('size',null, ['label'=>'Dimensions'])
            ->add('weight',null, ['label'=>'Poids'])
            ->add('lifespan',null, ['label'=>'Espérance de vie'])
            ->add('gestation',null, ['label'=>'Durée de gestation, nombre de petits'])
            ->add('statusIUCN','iucn_status_type', ['label'=>'Status IUCN'])
            ->add('classe',null, ['label'=>'Classe'])
            ->add('animalOrder',null, ['label'=>'Ordre'])
            ->add('family',null, ['label'=>'Famille'])
            ->add('genus',null, ['label'=>'Genre'])
            ->add('shortDescription',null, ['label'=>'Description courte'])
            ->add('longDescription',null, ['label'=>'Description longue'])
            ->add('save', 'submit', ['label'=>''])
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\AnimalSpecies']);
    }
    
    public function getName()
    {
        return 'animal_species_form';
    }
}
