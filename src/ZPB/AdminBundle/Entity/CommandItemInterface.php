<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 10/09/2014
 * Time: 11:10
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

namespace ZPB\AdminBundle\Entity;


interface CommandItemInterface
{

    public function getAmountTtc();

    public function getAmountHt();

    public function getTva();

    public function getCreatedAt();

    public function setAmountTtc($ttc);

    public function setAmountHt($hc);

    public function setTva($tva);

    public function setCreatedAt($createdAt);
}
