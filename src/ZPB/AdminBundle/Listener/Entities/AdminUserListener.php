<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 15/09/2014
 * Time: 11:33
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

namespace ZPB\AdminBundle\Listener\Entities;


use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use ZPB\AdminBundle\Entity\AdminUser;

class AdminUserListener
{
    private $encoder;

    public function __construct(EncoderFactoryInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if($entity instanceof AdminUser){
            $password = $this->handleEvent($entity);
            if($password){
                $entity->setPassword($password);
            }
        }
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        if($entity instanceof AdminUser){
            if($args->hasChangedField('password')){
                $password = $this->handleEvent($entity);
                if($password){
                    $args->setNewValue('password', $password);
                }
            }
        }
    }

    private function handleEvent(AdminUser $user)
    {
        if(!$user->getPlainPassword()){
            return false;
        }
        $encoder = $this->encoder->getEncoder($user);
        $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
        return $password;
    }
} 
