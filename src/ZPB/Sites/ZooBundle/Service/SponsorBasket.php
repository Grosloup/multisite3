<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 14/08/2014
 * Time: 11:57
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


use Symfony\Component\HttpFoundation\Session\SessionInterface;
use ZPB\AdminBundle\Entity\Godparent;

class SponsorBasket
{
    private $session;
    private $itemClass;
    private $key = 'zpb_sponsor_basket';
    private $basket;

    function __construct(SessionInterface $session, $itemClass="")
    {
        $this->session = $session;
        $this->itemClass = $itemClass;
        if(!$this->session->has($this->key)){
            $this->session->set($this->key, []);
        }

        $this->basket = $this->session->get($this->key);

    }

    public function isEmpty()
    {
        if(!$this->session->has($this->key)){
            return true;
        }
        return $this->count() === 0;
    }

    public function addItem($pack, $animal,Godparent $recipient = null)
    {
        $item = new $this->itemClass($pack, $animal, $recipient);
        $this->basket[$item->getId()] = $item;
        $this->session->set($this->key, $this->basket);
    }

    public function add($item)
    {
        $this->basket[$item->getId()] = $item;
        $this->session->set($this->key, $this->basket);
    }

    public function removeItem($itemId)
    {
        if(array_key_exists($itemId, $this->basket)){
            unset($this->basket[$itemId]);
            $this->session->set($this->key, $this->basket);
            return true;
        }
        return false;
    }

    public function flush()
    {
        $this->session->set($this->key, []);
    }

    public function count()
    {
        return count($this->session->get($this->key));
    }

    public function getItems()
    {
        return $this->session->get($this->key, null);
    }

    public function getLast()
    {
        if(!$this->isEmpty()){
            $basket = $this->session->get($this->key);
            $last = array_pop($basket);
            $this->session->set($this->key, $basket);
            return $last;
        }
        return null;

    }

    public function resolveUser($user)
    {
        $basket = $this->session->get($this->key);

        foreach($basket as $item){
            /** @var SponsorBasketItem $item */
            if($item->getGodparent() == null){
                $item->setGodparent($user);
            }
        }

        $this->session->set($this->key, $basket);
    }


}
