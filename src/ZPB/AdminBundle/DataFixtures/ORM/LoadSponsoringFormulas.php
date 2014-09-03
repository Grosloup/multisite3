<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 03/09/14
 * Time: 14:35
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

namespace ZPB\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use ZPB\AdminBundle\Entity\SponsoringFormula;

class LoadSponsoringFormulas extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container=null)
    {
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager)
    {
        $sf1 = new SponsoringFormula();
        $sf1->setName('Argent de poche');
        $sf1->setShortDescription('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, itaque.</p>');
        $sf1->setLongDescription('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet at commodi debitis deleniti dolor dolores eum, fugiat ipsa modi nisi odit optio quis rem repellendus reprehenderit tenetur vero. Accusantium consectetur delectus dicta eos laudantium magnam nam nulla optio provident quaerat ratione sequi tempora temporibus, unde vitae, voluptatem voluptatum. Aliquid, esse?</p>');
        $sf1->setIsActive(true);
        $sf1->setTaxRate(0.34);
        $sf1->setPrice(15);
        $sf1->setTaxFreePrice(15 * 0.34);
        $sf1->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-1'));
        $this->getReference('zpb-sponsor-gift-desc-1')->addFormula($sf1);
        $sf1->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-2'));
        $this->getReference('zpb-sponsor-gift-desc-2')->addFormula($sf1);
        $sf1->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-3'));
        $this->getReference('zpb-sponsor-gift-desc-3')->addFormula($sf1);
        $sf1->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-4'));
        $this->getReference('zpb-sponsor-gift-desc-4')->addFormula($sf1);
        $sf1->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-5'));
        $this->getReference('zpb-sponsor-gift-desc-5')->addFormula($sf1);
        $sf1->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-6'));
        $this->getReference('zpb-sponsor-gift-desc-6')->addFormula($sf1);
        $sf1->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-7'));
        $this->getReference('zpb-sponsor-gift-desc-7')->addFormula($sf1);
        $manager->persist($sf1);


        $sf2 = new SponsoringFormula();
        $sf2->setName('Ituri');
        $sf2->setShortDescription('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, itaque.</p>');
        $sf2->setLongDescription('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet at commodi debitis deleniti dolor dolores eum, fugiat ipsa modi nisi odit optio quis rem repellendus reprehenderit tenetur vero. Accusantium consectetur delectus dicta eos laudantium magnam nam nulla optio provident quaerat ratione sequi tempora temporibus, unde vitae, voluptatem voluptatum. Aliquid, esse?</p>');
        $sf2->setIsActive(true);
        $sf2->setTaxRate(0.34);
        $sf2->setPrice(50);
        $sf2->setTaxFreePrice(50 * 0.34);
        $sf2->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-1'));
        $this->getReference('zpb-sponsor-gift-desc-1')->addFormula($sf2);
        $sf2->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-2'));
        $this->getReference('zpb-sponsor-gift-desc-2')->addFormula($sf2);
        $sf2->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-3'));
        $this->getReference('zpb-sponsor-gift-desc-3')->addFormula($sf2);
        $sf2->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-4'));
        $this->getReference('zpb-sponsor-gift-desc-4')->addFormula($sf2);
        $sf2->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-5'));
        $this->getReference('zpb-sponsor-gift-desc-5')->addFormula($sf2);
        $sf2->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-6'));
        $this->getReference('zpb-sponsor-gift-desc-6')->addFormula($sf2);
        $sf2->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-7'));
        $this->getReference('zpb-sponsor-gift-desc-7')->addFormula($sf2);
        $sf2->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-8'));
        $this->getReference('zpb-sponsor-gift-desc-8')->addFormula($sf2);


        $sf3 = new SponsoringFormula();
        $sf3->setName('Baobab');
        $sf3->setShortDescription('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, itaque.</p>');
        $sf3->setLongDescription('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet at commodi debitis deleniti dolor dolores eum, fugiat ipsa modi nisi odit optio quis rem repellendus reprehenderit tenetur vero. Accusantium consectetur delectus dicta eos laudantium magnam nam nulla optio provident quaerat ratione sequi tempora temporibus, unde vitae, voluptatem voluptatum. Aliquid, esse?</p>');
        $sf3->setIsActive(true);
        $sf3->setTaxRate(0.34);
        $sf3->setPrice(80);
        $sf3->setTaxFreePrice(80 * 0.34);
        $sf3-> addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-1'));
        $this->getReference('zpb-sponsor-gift-desc-1')->addFormula($sf3);
        $sf3-> addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-2'));
        $this->getReference('zpb-sponsor-gift-desc-2')->addFormula($sf3);
        $sf3-> addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-3'));
        $this->getReference('zpb-sponsor-gift-desc-3')->addFormula($sf3);
        $sf3-> addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-4'));
        $this->getReference('zpb-sponsor-gift-desc-4')->addFormula($sf3);
        $sf3-> addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-5'));
        $this->getReference('zpb-sponsor-gift-desc-5')->addFormula($sf3);
        $sf3-> addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-6'));
        $this->getReference('zpb-sponsor-gift-desc-6')->addFormula($sf3);
        $sf3-> addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-7'));
        $this->getReference('zpb-sponsor-gift-desc-7')->addFormula($sf3);
        $sf3-> addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-8'));
        $this->getReference('zpb-sponsor-gift-desc-8')->addFormula($sf3);
        $sf3-> addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-9'));
        $this->getReference('zpb-sponsor-gift-desc-9')->addFormula($sf3);
        $sf3-> addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-13'));
        $this->getReference('zpb-sponsor-gift-desc-13')->addFormula($sf3);
        

        $sf4 = new SponsoringFormula();
        $sf4->setName('Oiseau de paradis');
        $sf4->setShortDescription('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, itaque.</p>');
        $sf4->setLongDescription('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet at commodi debitis deleniti dolor dolores eum, fugiat ipsa modi nisi odit optio quis rem repellendus reprehenderit tenetur vero. Accusantium consectetur delectus dicta eos laudantium magnam nam nulla optio provident quaerat ratione sequi tempora temporibus, unde vitae, voluptatem voluptatum. Aliquid, esse?</p>');
        $sf4->setIsActive(true);
        $sf4->setTaxRate(0.34);
        $sf4->setPrice(130);
        $sf4->setTaxFreePrice(130 * 0.34);
        $sf4->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-1'));
        $this->getReference('zpb-sponsor-gift-desc-1')->addFormula($sf4);
        $sf4->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-2'));
        $this->getReference('zpb-sponsor-gift-desc-2')->addFormula($sf4);
        $sf4->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-3'));
        $this->getReference('zpb-sponsor-gift-desc-3')->addFormula($sf4);
        $sf4->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-4'));
        $this->getReference('zpb-sponsor-gift-desc-4')->addFormula($sf4);
        $sf4->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-5'));
        $this->getReference('zpb-sponsor-gift-desc-5')->addFormula($sf4);
        $sf4->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-6'));
        $this->getReference('zpb-sponsor-gift-desc-6')->addFormula($sf4);
        $sf4->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-7'));
        $this->getReference('zpb-sponsor-gift-desc-7')->addFormula($sf4);
        $sf4->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-8'));
        $this->getReference('zpb-sponsor-gift-desc-8')->addFormula($sf4);
        $sf4->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-10'));
        $this->getReference('zpb-sponsor-gift-desc-10')->addFormula($sf4);
        $sf4->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-13'));
        $this->getReference('zpb-sponsor-gift-desc-13')->addFormula($sf4);
        $sf4->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-14'));
        $this->getReference('zpb-sponsor-gift-desc-14')->addFormula($sf4);


        $sf5 = new SponsoringFormula();
        $sf5->setName('Analabé');
        $sf5->setShortDescription('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, itaque.</p>');
        $sf5->setLongDescription('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet at commodi debitis deleniti dolor dolores eum, fugiat ipsa modi nisi odit optio quis rem repellendus reprehenderit tenetur vero. Accusantium consectetur delectus dicta eos laudantium magnam nam nulla optio provident quaerat ratione sequi tempora temporibus, unde vitae, voluptatem voluptatum. Aliquid, esse?</p>');
        $sf5->setIsActive(true);
        $sf5->setTaxRate(0.34);
        $sf5->setPrice(500);
        $sf5->setTaxFreePrice(500 * 0.34);
        $sf5->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-1'));
        $this->getReference('zpb-sponsor-gift-desc-1')->addFormula($sf5);
        $sf5->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-2'));
        $this->getReference('zpb-sponsor-gift-desc-2')->addFormula($sf5);
        $sf5->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-3'));
        $this->getReference('zpb-sponsor-gift-desc-3')->addFormula($sf5);
        $sf5->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-4'));
        $this->getReference('zpb-sponsor-gift-desc-4')->addFormula($sf5);
        $sf5->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-5'));
        $this->getReference('zpb-sponsor-gift-desc-5')->addFormula($sf5);
        $sf5->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-6'));
        $this->getReference('zpb-sponsor-gift-desc-6')->addFormula($sf5);
        $sf5->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-7'));
        $this->getReference('zpb-sponsor-gift-desc-7')->addFormula($sf5);
        $sf5->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-8'));
        $this->getReference('zpb-sponsor-gift-desc-8')->addFormula($sf5);
        $sf5->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-11'));
        $this->getReference('zpb-sponsor-gift-desc-11')->addFormula($sf5);
        $sf5->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-13'));
        $this->getReference('zpb-sponsor-gift-desc-13')->addFormula($sf5);
        $sf5->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-14'));
        $this->getReference('zpb-sponsor-gift-desc-14')->addFormula($sf5);
        $sf5->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-15'));
        $this->getReference('zpb-sponsor-gift-desc-15')->addFormula($sf5);


        $sf6 = new SponsoringFormula();
        $sf6->setName('Séquoia');
        $sf6->setShortDescription('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, itaque.</p>');
        $sf6->setLongDescription('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet at commodi debitis deleniti dolor dolores eum, fugiat ipsa modi nisi odit optio quis rem repellendus reprehenderit tenetur vero. Accusantium consectetur delectus dicta eos laudantium magnam nam nulla optio provident quaerat ratione sequi tempora temporibus, unde vitae, voluptatem voluptatum. Aliquid, esse?</p>');
        $sf6->setIsActive(true);
        $sf6->setTaxRate(0.34);
        $sf6->setPrice(1000);
        $sf6->setTaxFreePrice(1000 * 0.34);
        $sf6->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-1'));
        $this->getReference('zpb-sponsor-gift-desc-1')->addFormula($sf6);
        $sf6->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-2'));
        $this->getReference('zpb-sponsor-gift-desc-2')->addFormula($sf6);
        $sf6->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-3'));
        $this->getReference('zpb-sponsor-gift-desc-3')->addFormula($sf6);
        $sf6->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-4'));
        $this->getReference('zpb-sponsor-gift-desc-4')->addFormula($sf6);
        $sf6->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-5'));
        $this->getReference('zpb-sponsor-gift-desc-5')->addFormula($sf6);
        $sf6->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-6'));
        $this->getReference('zpb-sponsor-gift-desc-6')->addFormula($sf6);
        $sf6->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-7'));
        $this->getReference('zpb-sponsor-gift-desc-7')->addFormula($sf6);
        $sf6->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-8'));
        $this->getReference('zpb-sponsor-gift-desc-8')->addFormula($sf6);
        $sf6->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-12'));
        $this->getReference('zpb-sponsor-gift-desc-12')->addFormula($sf6);
        $sf6->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-13'));
        $this->getReference('zpb-sponsor-gift-desc-13')->addFormula($sf6);
        $sf6->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-14'));
        $this->getReference('zpb-sponsor-gift-desc-14')->addFormula($sf6);
        $sf6->addGiftDefinitions($this->getReference('zpb-sponsor-gift-desc-16'));
        $this->getReference('zpb-sponsor-gift-desc-16')->addFormula($sf6);
        
        

        $manager->persist($this->getReference('zpb-sponsor-gift-desc-1'));
        $manager->persist($this->getReference('zpb-sponsor-gift-desc-2'));
        $manager->persist($this->getReference('zpb-sponsor-gift-desc-3'));
        $manager->persist($this->getReference('zpb-sponsor-gift-desc-4'));
        $manager->persist($this->getReference('zpb-sponsor-gift-desc-5'));
        $manager->persist($this->getReference('zpb-sponsor-gift-desc-6'));
        $manager->persist($this->getReference('zpb-sponsor-gift-desc-7'));
        $manager->persist($this->getReference('zpb-sponsor-gift-desc-8'));
        $manager->persist($this->getReference('zpb-sponsor-gift-desc-9'));
        $manager->persist($this->getReference('zpb-sponsor-gift-desc-10'));
        $manager->persist($this->getReference('zpb-sponsor-gift-desc-11'));
        $manager->persist($this->getReference('zpb-sponsor-gift-desc-12'));
        $manager->persist($this->getReference('zpb-sponsor-gift-desc-13'));
        $manager->persist($this->getReference('zpb-sponsor-gift-desc-14'));
        $manager->persist($this->getReference('zpb-sponsor-gift-desc-15'));
        $manager->persist($this->getReference('zpb-sponsor-gift-desc-16'));

        $manager->persist($sf1);
        $manager->persist($sf2);
        $manager->persist($sf3);
        $manager->persist($sf4);
        $manager->persist($sf5);
        $manager->persist($sf6);

        $manager->flush();

        $this->addReference('zpb-sponsor-sponsor-desc-1', $sf1);
        $this->addReference('zpb-sponsor-sponsor-desc-2', $sf2);
        $this->addReference('zpb-sponsor-sponsor-desc-3', $sf3);
        $this->addReference('zpb-sponsor-sponsor-desc-4', $sf4);
        $this->addReference('zpb-sponsor-sponsor-desc-5', $sf5);
        $this->addReference('zpb-sponsor-sponsor-desc-6', $sf6);

    }
    
    public function getOrder()
    {
        return 38;
    }
}
