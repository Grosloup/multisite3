<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 10/09/2014
 * Time: 22:17
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
use Symfony\Component\Validator\Constraints as Assert;

class GetGodparentByEmailType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',null,['label'=>'Email', 'constraints'=> [new Assert\NotBlank(), new Assert\Email()]])
            ->add('search', 'submit', ['label'=>'Enregister'])
        ;
    }

    /*public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class'=>'']);
    }*/

	public function getName()
	{
		return 'godparent_by_email_form';
	}
}
