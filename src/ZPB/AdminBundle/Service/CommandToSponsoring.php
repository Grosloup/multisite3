<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 28/09/2014
 * Time: 07:14
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

namespace ZPB\AdminBundle\Service;


use Doctrine\ORM\EntityManager;
use ZPB\AdminBundle\Entity\Command;
use ZPB\AdminBundle\Entity\CommandItem;

class CommandToSponsoring
{
    /**
     * @var EntityManager
     */
    private $em;
    private $sponsoringClass;

    public function __construct(EntityManager $em, $sponsoringClass)
    {
        $this->em = $em;
        $this->sponsoringClass;
    }

    public function transformCommand(Command $command)
    {
        $items = $command->getCommandItems();
        foreach($items as $item){
            $this->transformCommandItem($item, $command->getValidateAt());
        }
    }

    private function transformCommandItem(CommandItem $item, \DateTime $validateAt)
    {
        $sponsoringClass = $this->sponsoringClass;
        /** @var \ZPB\AdminBundle\Entity\Sponsoring $sponsoring */
        $sponsoring = new $sponsoringClass();

        $sponsoring->setGodparent($item->getGodparent());
        $sponsoring->setFormula($item->getFormula());
        $sponsoring->setDelayedAt($item->getDelayedAt());
        if($item->getDelayedAt() != null){

            $sponsoring->setIsActive(false);
        } else {

            $sponsoring->setIsActive(true);
        }
        $sponsoring->setStartAt($validateAt);
        $end = $validateAt;
        $end->add(new \DateInterval("P1Y"));
        $sponsoring->setEndAt($end);

        $sponsoring->setAnimal($item->getAnimal());
        $sponsoring->setCommand($item->getCommand());
        $sponsoring->setIsPresent($item->getIsPresent());
        $sponsoring->setType($item->getCommand()->getType());

        $this->em->persist($sponsoring);
        $this->em->flush();

    }
}
