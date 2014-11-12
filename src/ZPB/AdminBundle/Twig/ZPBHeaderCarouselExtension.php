<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 12/11/2014
 * Time: 14:46
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

namespace ZPB\AdminBundle\Twig;


class ZPBHeaderCarouselExtension extends \Twig_Extension {

    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return [

        ];
    }

    public function getService($service)
    {

    }

    public function getName()
    {
        return 'zpb_header_carousel_extension';
    }
} 
