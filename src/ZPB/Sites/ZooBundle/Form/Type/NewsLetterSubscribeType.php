<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 20/09/2014
 * Time: 21:56
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

namespace ZPB\Sites\ZooBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsLetterSubscribeType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civilite', 'civility_type', ['label'=>'Civilité','empty_value'=>'------------'])
            ->add('firstname',null,['label'=>'Prénom*'])
            ->add('lastname', null, ['label'=>'Nom*'])
            ->add('email','email',['label'=>'Adresse email*'])
            ->add('bornAt','date',['label'=>'Date de naissance (jj/mm/aaaa)','input'=>'datetime','widget'=>'single_text','format'=>'dd/MM/yyyy'])
            ->add('name',null,['label'=>'Si vous êtes humain, laissez ce champs vide !', 'mapped'=>false])
            ->add('save', 'submit', ['label'=>'Enregistrement'])
        ;
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\NewsletterSubscriber']);
	}

	public function getName()
	{
		return 'newsletter_subscribe_form';
	}
}
