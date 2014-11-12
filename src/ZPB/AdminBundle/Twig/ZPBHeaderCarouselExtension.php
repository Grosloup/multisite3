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

use Symfony\Component\DependencyInjection\ContainerInterface;

class ZPBHeaderCarouselExtension extends \Twig_Extension {

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('header_carousel', [$this, 'renderHeaderCarousel'], ['is_safe'=>['html']])
        ];
    }

    function renderHeaderCarousel($twigFile)
    {
        return $this->getService('templating')->render($twigFile, []);
    }

    public function getService($service, $default = null)
    {
        if($this->container->has($service)){
            return $this->container->get($service);
        }
        return $default;

    }

    public function getName()
    {
        return 'zpb_header_carousel_extension';
    }
} 
