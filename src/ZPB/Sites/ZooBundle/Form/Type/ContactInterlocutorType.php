<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 11/10/2014
 * Time: 01:13
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
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactInterlocutorType extends AbstractType
{
    private $interlocutorsChoices;


    function __construct(array $interlocutorsChoices)
    {
        $this->interlocutorsChoices = $interlocutorsChoices;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['choices'=>$this->interlocutorsChoices]);
    }

    public function getParent()
    {
        return 'choice';
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'contact_interlocutors_type';
    }
}
