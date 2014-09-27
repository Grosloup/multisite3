<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 27/09/2014
 * Time: 16:16
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


class BankMacMaker
{
    private $options;

    public function __construct($options = [])
    {
        $this->options = $options;
    }

    public function createMac($dateFormated, $amount, $refCommand, $freeText, $userEmail)
    {
        $tmpArray = [
            $this->options['TPE'],
            $dateFormated,
            $amount,
            $refCommand,
            $freeText,
            $this->options['version'],
            $this->options['lgue'],
            $this->options['societe'],
            $userEmail
        ];
        $concat = implode('*', $tmpArray) . '**********';
        return hash_hmac('sha1', $concat, $this->getUsableKey());
    }

    private function getUsableKey()
    {
        $hexStrKey = substr($this->options['securityKey'], 0, 38);
        $hexFinal = "" . substr($this->options['securityKey'], 38, 2) . "00";
        $cca0=ord($hexFinal);
        if ($cca0>70 && $cca0<97)
            $hexStrKey .= chr($cca0-23) . substr($hexFinal, 1, 1);
        else {
            if (substr($hexFinal, 1, 1)=="M")
                $hexStrKey .= substr($hexFinal, 0, 1) . "0";
            else
                $hexStrKey .= substr($hexFinal, 0, 2);
        }
        return pack("H*", $hexStrKey);
    }

    public function validateMac($mac, $datas)
    {
        return $mac === $this->createMac($datas['dateFormated'],$datas['amount'],$datas['refCommand'],$datas['freeText'],$datas['userEmail']);
    }
}
