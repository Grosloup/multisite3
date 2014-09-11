<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 01/09/14
 * Time: 09:14
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


interface ResizeableInterface
{
    public function getWidth();

    public function getHeight();

    public function getAbsolutePath();

    public function getMime();

    public function getFilename();

    public function getExtension();

}
