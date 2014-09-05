<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 05/09/2014
 * Time: 15:51
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

class SexeType extends AbstractType
{
    private $sexe;


    function __construct(array $sexe)
    {
        $this->sexe = $sexe;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['choices'=>$this->sexe]);
    }
    
    public function getName()
    {
        return 'sexe_type';
    }

    public function getParent()
    {
        return 'choice';
    }
}
