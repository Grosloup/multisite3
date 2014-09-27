<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 27/09/2014
 * Time: 14:06
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

namespace ZPB\Sites\ZooBundle\Service;


use Doctrine\ORM\EntityManager;
use ZPB\AdminBundle\Entity\Godparent;

class BasketToCommand
{
    private $commandClass;
    private $commandItemClass;
    /**
     * @var EntityManager
     */
    private $em;
    private $allowedTypes;

    public function __construct(EntityManager $em, $commandClass, $commandItemClass, $allowedTypes)
    {
        $this->em = $em;
        $this->commandClass = $commandClass;
        $this->commandItemClass = $commandItemClass;
        $this->allowedTypes = $allowedTypes;
    }

    public function createCommand(SponsorBasket $basket, $type, Godparent $godparent)
    {
        if(!in_array($type, $this->allowedTypes, true)){
            throw new \RuntimeException("Type indéfini pour commande parrainage");
        }
        if($godparent == null){
            throw new \RuntimeException("Parrain indéfini pour commande parrainage");
        }
        $commandClass = $this->commandClass;
        $command = null;
        $totalAmountHT = 0;
        $totalAmountTTC = 0;
        if(!$basket->isEmpty()){
            /** @var \ZPB\AdminBundle\Entity\Command $command */
            $command = new $commandClass();
            $command->setType($type);
            $commandItemClass = $this->commandItemClass;
            foreach($basket->getItems() as $k=>$item){
                /** @var \ZPB\AdminBundle\Entity\CommandItem $commandItem */
                $commandItem = new $commandItemClass();
                if(null != $item->getGodparent()){
                    $itemGodparent = $this->em->find(get_class($item->getGodparent()), $item->getGodparent()->getId());
                } else {
                    $itemGodparent = $godparent;
                }
                /** @var \ZPB\AdminBundle\Entity\Animal $animal */
                $animal = $this->em->find(get_class($item->getAnimal()), $item->getAnimal()->getId());
                /** @var \ZPB\AdminBundle\Entity\SponsoringFormula $formula */
                $formula = $this->em->find(get_class($item->getPack()), $item->getPack()->getId());

                $delayed = $item->getDelayedAt();
                $commandItem->setAmountHt($formula->getHtPrice());
                $totalAmountHT += $formula->getHtPrice();
                $commandItem->setAmountTtc($formula->getPrice());
                $totalAmountTTC += $formula->getPrice();
                $commandItem->setTva($formula->getTva());

                $commandItem->setFormula($formula);
                $commandItem->setGodparent($itemGodparent);
                $commandItem->setAnimal($animal);
                $commandItem->setDelayedAt($delayed);
                if($itemGodparent->getId() != $godparent->getId()){
                    $commandItem->setIsPresent(true);
                }
                $commandItem->setCommand($command);

                $this->em->persist($commandItem);
                $command->addCommandItem($commandItem);
            }

            $command->setTotalAmount($totalAmountHT);
            $command->setTotalAmountTtc($totalAmountTTC);
            $this->em->persist($command);
            $this->em->flush();

        }



        return $command;
    }
}
