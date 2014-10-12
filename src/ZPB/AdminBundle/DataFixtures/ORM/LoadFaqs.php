<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 09/09/2014
 * Time: 09:05
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
use ZPB\AdminBundle\Entity\FAQ;

class LoadFaqs extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container=null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $faq1 = new FAQ();
        $faq1->setQuestion('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')->setResponse('Nunc congue id lorem vitae fermentum. Curabitur et est finibus, sodales libero sed, vestibulum odio. Phasellus ac tellus ac lacus maximus consequat. Nullam in nunc viverra, maximus orci id, pellentesque ante. Morbi quis blandit elit, quis tincidunt justo')
        ->setInstitution($this->getReference('zpb-instit-1'));
        $manager->persist($faq1);

        $faq2 = new FAQ();
        $faq2->setQuestion(' Vestibulum suscipit sit amet tortor volutpat congue. Curabitur lorem nulla, laoreet vel nibh ac, consequat ultricies enim ?')->setResponse('Donec sit amet risus eu dui interdum malesuada. Praesent non augue ullamcorper, lobortis mi id, placerat orci. Donec suscipit tempus nibh ut molestie. Sed sed metus sit amet elit euismod luctus.')
        ->setInstitution($this->getReference('zpb-instit-2'));
        $manager->persist($faq2);

        $faq3 = new FAQ();
        $faq3->setQuestion('Ut at nibh ac lectus consectetur auctor quis eu enim. Pellentesque dapibus lectus lobortis orci scelerisque tincidunt ?')->setResponse('Vestibulum mollis, felis vel commodo pretium, erat tellus fringilla nulla, at accumsan tortor tellus sit amet mi. Nullam interdum, elit in convallis fermentum, magna magna semper magna, et congue ante sapien vitae neque. Nam non quam sed elit dignissim molestie. Etiam vitae tempor massa.')
        ->setInstitution($this->getReference('zpb-instit-2'));
        $manager->persist($faq3);

        $faq4 = new FAQ();
        $faq4->setQuestion('Nunc varius neque vitae augue sodales, quis suscipit tortor mattis ?')->setResponse('Curabitur eget euismod eros. Sed sit amet nulla molestie felis dignissim laoreet in sit amet nibh. Mauris ultricies neque eu ipsum dictum, non accumsan lacus bibendum. Phasellus posuere ultricies libero vitae sagittis. Integer eget dolor sit amet libero pharetra commodo.')
        ->setInstitution($this->getReference('zpb-instit-3'));
        $manager->persist($faq4);

        $faq5 = new FAQ();
        $faq5->setQuestion('Proin tellus nisl, laoreet sed gravida quis, rhoncus ullamcorper neque ?')->setResponse('Cras tristique consequat tellus quis bibendum. Nullam vel quam et magna gravida finibus in vel ipsum. Ut sollicitudin porttitor ornare. Morbi nisi neque, dignissim ac vulputate ac, dictum quis libero. Suspendisse potenti. Duis eu quam accumsan, blandit nibh ac, congue tellus.')
        ->setInstitution($this->getReference('zpb-instit-3'));
        $manager->persist($faq5);

        $faq6 = new FAQ();
        $faq6->setQuestion('Donec sit amet massa mauris. Nullam sed ante eu libero hendrerit porttitor eget et risus ?')->setResponse('Quisque eu nisl commodo, semper leo ac, viverra nisl. Nulla nec porta arcu. Donec ut porta tortor. Phasellus varius, risus sed maximus faucibus, velit orci egestas augue, sed fermentum metus nulla non nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.')
        ->setInstitution($this->getReference('zpb-instit-4'));
        $manager->persist($faq6);

        $faq7 = new FAQ();
        $faq7->setQuestion('Mauris consectetur lorem at viverra scelerisque. Morbi commodo erat turpis ?')->setResponse('In cursus neque id facilisis vulputate. Nulla porta tortor sit amet lobortis rutrum. Phasellus faucibus lacus ac dictum sollicitudin. Vivamus viverra, nisi venenatis malesuada dictum, nulla arcu pretium nisl, non dapibus ligula elit at est.')
        ->setInstitution($this->getReference('zpb-instit-4'));
        $manager->persist($faq7);

        $faq8 = new FAQ();
        $faq8->setQuestion('In cursus neque id facilisis vulputate ?')->setResponse('Nam accumsan facilisis nulla, ut commodo mi rhoncus sit amet. Aenean eu magna pulvinar, vulputate tortor quis, imperdiet erat. Cras sit amet auctor risus. Quisque ligula velit, sollicitudin in est in, faucibus ornare ex. ')
        ->setInstitution($this->getReference('zpb-instit-4'));
        $manager->persist($faq8);

        $faq9 = new FAQ();
        $faq9->setQuestion('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')->setResponse('Nunc congue id lorem vitae fermentum. Curabitur et est finibus, sodales libero sed, vestibulum odio. Phasellus ac tellus ac lacus maximus consequat. Nullam in nunc viverra, maximus orci id, pellentesque ante. Morbi quis blandit elit, quis tincidunt justo')
            ->setInstitution($this->getReference('zpb-instit-1'));
        $manager->persist($faq9);

        $faq10 = new FAQ();
        $faq10->setQuestion('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')->setResponse('Nunc congue id lorem vitae fermentum. Curabitur et est finibus, sodales libero sed, vestibulum odio. Phasellus ac tellus ac lacus maximus consequat. Nullam in nunc viverra, maximus orci id, pellentesque ante. Morbi quis blandit elit, quis tincidunt justo')
            ->setInstitution($this->getReference('zpb-instit-1'));
        $manager->persist($faq10);

        $faq11 = new FAQ();
        $faq11->setQuestion('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')->setResponse('Nunc congue id lorem vitae fermentum. Curabitur et est finibus, sodales libero sed, vestibulum odio. Phasellus ac tellus ac lacus maximus consequat. Nullam in nunc viverra, maximus orci id, pellentesque ante. Morbi quis blandit elit, quis tincidunt justo')
            ->setInstitution($this->getReference('zpb-instit-1'));
        $manager->persist($faq11);

        $faq12 = new FAQ();
        $faq12->setQuestion('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')->setResponse('Nunc congue id lorem vitae fermentum. Curabitur et est finibus, sodales libero sed, vestibulum odio. Phasellus ac tellus ac lacus maximus consequat. Nullam in nunc viverra, maximus orci id, pellentesque ante. Morbi quis blandit elit, quis tincidunt justo')
            ->setInstitution($this->getReference('zpb-instit-1'));
        $manager->persist($faq12);

        $faq13 = new FAQ();
        $faq13->setQuestion('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')->setResponse('Nunc congue id lorem vitae fermentum. Curabitur et est finibus, sodales libero sed, vestibulum odio. Phasellus ac tellus ac lacus maximus consequat. Nullam in nunc viverra, maximus orci id, pellentesque ante. Morbi quis blandit elit, quis tincidunt justo')
            ->setInstitution($this->getReference('zpb-instit-1'));
        $manager->persist($faq13);

        $faq14 = new FAQ();
        $faq14->setQuestion('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')->setResponse('Nunc congue id lorem vitae fermentum. Curabitur et est finibus, sodales libero sed, vestibulum odio. Phasellus ac tellus ac lacus maximus consequat. Nullam in nunc viverra, maximus orci id, pellentesque ante. Morbi quis blandit elit, quis tincidunt justo')
            ->setInstitution($this->getReference('zpb-instit-1'));
        $manager->persist($faq14);


        $faq15 = new FAQ();
        $faq15->setQuestion('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')
            ->setResponse('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')->setResponse('Nunc congue id lorem vitae fermentum. Curabitur et est finibus, sodales libero sed, vestibulum odio. Phasellus ac tellus ac lacus maximus consequat. Nullam in nunc viverra, maximus orci id, pellentesque ante. Morbi quis blandit elit, quis tincidunt justoQuisque sit amet odio pellentesque, tempus nulla id, ultrices dolor. Ut porta magna nec dui congue sodales imperdiet non metus. In pharetra non lectus id ullamcorper. Praesent vel consectetur elit. Proin dignissim eleifend orci, vel vestibulum nunc malesuada et. Vivamus consectetur ipsum sed sapien tincidunt, a malesuada est elementum. Sed facilisis congue ante ut finibus. Donec tincidunt tortor in nisl auctor, ut facilisis nisl sagittis.')
            ->setInstitution($this->getReference('zpb-instit-5'));
        $manager->persist($faq15);

        $faq16 = new FAQ();
        $faq16->setQuestion('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')
            ->setResponse('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')->setResponse('Nunc congue id lorem vitae fermentum. Curabitur et est finibus, sodales libero sed, vestibulum odio. Phasellus ac tellus ac lacus maximus consequat. Nullam in nunc viverra, maximus orci id, pellentesque ante. Morbi quis blandit elit, quis tincidunt justoQuisque sit amet odio pellentesque, tempus nulla id, ultrices dolor. Ut porta magna nec dui congue sodales imperdiet non metus. In pharetra non lectus id ullamcorper. Praesent vel consectetur elit. Proin dignissim eleifend orci, vel vestibulum nunc malesuada et. Vivamus consectetur ipsum sed sapien tincidunt, a malesuada est elementum. Sed facilisis congue ante ut finibus. Donec tincidunt tortor in nisl auctor, ut facilisis nisl sagittis.')
            ->setInstitution($this->getReference('zpb-instit-6'));
        $manager->persist($faq16);

        $faq17 = new FAQ();
        $faq17->setQuestion('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')
            ->setResponse('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')->setResponse('Nunc congue id lorem vitae fermentum. Curabitur et est finibus, sodales libero sed, vestibulum odio. Phasellus ac tellus ac lacus maximus consequat. Nullam in nunc viverra, maximus orci id, pellentesque ante. Morbi quis blandit elit, quis tincidunt justoQuisque sit amet odio pellentesque, tempus nulla id, ultrices dolor. Ut porta magna nec dui congue sodales imperdiet non metus. In pharetra non lectus id ullamcorper. Praesent vel consectetur elit. Proin dignissim eleifend orci, vel vestibulum nunc malesuada et. Vivamus consectetur ipsum sed sapien tincidunt, a malesuada est elementum. Sed facilisis congue ante ut finibus. Donec tincidunt tortor in nisl auctor, ut facilisis nisl sagittis.')
            ->setInstitution($this->getReference('zpb-instit-7'));
        $manager->persist($faq17);

        $faq18 = new FAQ();
        $faq18->setQuestion('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')
            ->setResponse('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')->setResponse('Nunc congue id lorem vitae fermentum. Curabitur et est finibus, sodales libero sed, vestibulum odio. Phasellus ac tellus ac lacus maximus consequat. Nullam in nunc viverra, maximus orci id, pellentesque ante. Morbi quis blandit elit, quis tincidunt justoQuisque sit amet odio pellentesque, tempus nulla id, ultrices dolor. Ut porta magna nec dui congue sodales imperdiet non metus. In pharetra non lectus id ullamcorper. Praesent vel consectetur elit. Proin dignissim eleifend orci, vel vestibulum nunc malesuada et. Vivamus consectetur ipsum sed sapien tincidunt, a malesuada est elementum. Sed facilisis congue ante ut finibus. Donec tincidunt tortor in nisl auctor, ut facilisis nisl sagittis.')
            ->setInstitution($this->getReference('zpb-instit-8'));
        $manager->persist($faq18);


        $faq19 = new FAQ();
        $faq19->setQuestion('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')
            ->setResponse('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')->setResponse('Nunc congue id lorem vitae fermentum. Curabitur et est finibus, sodales libero sed, vestibulum odio. Phasellus ac tellus ac lacus maximus consequat. Nullam in nunc viverra, maximus orci id, pellentesque ante. Morbi quis blandit elit, quis tincidunt justoQuisque sit amet odio pellentesque, tempus nulla id, ultrices dolor. Ut porta magna nec dui congue sodales imperdiet non metus. In pharetra non lectus id ullamcorper. Praesent vel consectetur elit. Proin dignissim eleifend orci, vel vestibulum nunc malesuada et. Vivamus consectetur ipsum sed sapien tincidunt, a malesuada est elementum. Sed facilisis congue ante ut finibus. Donec tincidunt tortor in nisl auctor, ut facilisis nisl sagittis.')
            ->setInstitution($this->getReference('zpb-instit-5'));
        $manager->persist($faq19);

        $faq20 = new FAQ();
        $faq20->setQuestion('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')
            ->setResponse('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')->setResponse('Nunc congue id lorem vitae fermentum. Curabitur et est finibus, sodales libero sed, vestibulum odio. Phasellus ac tellus ac lacus maximus consequat. Nullam in nunc viverra, maximus orci id, pellentesque ante. Morbi quis blandit elit, quis tincidunt justoQuisque sit amet odio pellentesque, tempus nulla id, ultrices dolor. Ut porta magna nec dui congue sodales imperdiet non metus. In pharetra non lectus id ullamcorper. Praesent vel consectetur elit. Proin dignissim eleifend orci, vel vestibulum nunc malesuada et. Vivamus consectetur ipsum sed sapien tincidunt, a malesuada est elementum. Sed facilisis congue ante ut finibus. Donec tincidunt tortor in nisl auctor, ut facilisis nisl sagittis.')
            ->setInstitution($this->getReference('zpb-instit-6'));
        $manager->persist($faq20);

        $faq21 = new FAQ();
        $faq21->setQuestion('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')
            ->setResponse('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')->setResponse('Nunc congue id lorem vitae fermentum. Curabitur et est finibus, sodales libero sed, vestibulum odio. Phasellus ac tellus ac lacus maximus consequat. Nullam in nunc viverra, maximus orci id, pellentesque ante. Morbi quis blandit elit, quis tincidunt justoQuisque sit amet odio pellentesque, tempus nulla id, ultrices dolor. Ut porta magna nec dui congue sodales imperdiet non metus. In pharetra non lectus id ullamcorper. Praesent vel consectetur elit. Proin dignissim eleifend orci, vel vestibulum nunc malesuada et. Vivamus consectetur ipsum sed sapien tincidunt, a malesuada est elementum. Sed facilisis congue ante ut finibus. Donec tincidunt tortor in nisl auctor, ut facilisis nisl sagittis.')
            ->setInstitution($this->getReference('zpb-instit-7'));
        $manager->persist($faq21);

        $faq22 = new FAQ();
        $faq22->setQuestion('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')
            ->setResponse('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')->setResponse('Nunc congue id lorem vitae fermentum. Curabitur et est finibus, sodales libero sed, vestibulum odio. Phasellus ac tellus ac lacus maximus consequat. Nullam in nunc viverra, maximus orci id, pellentesque ante. Morbi quis blandit elit, quis tincidunt justoQuisque sit amet odio pellentesque, tempus nulla id, ultrices dolor. Ut porta magna nec dui congue sodales imperdiet non metus. In pharetra non lectus id ullamcorper. Praesent vel consectetur elit. Proin dignissim eleifend orci, vel vestibulum nunc malesuada et. Vivamus consectetur ipsum sed sapien tincidunt, a malesuada est elementum. Sed facilisis congue ante ut finibus. Donec tincidunt tortor in nisl auctor, ut facilisis nisl sagittis.')
            ->setInstitution($this->getReference('zpb-instit-8'));
        $manager->persist($faq22);

        $faq23 = new FAQ();
        $faq23->setQuestion('Commune 1 Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')
            ->setResponse('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')->setResponse('Nunc congue id lorem vitae fermentum. Curabitur et est finibus, sodales libero sed, vestibulum odio. Phasellus ac tellus ac lacus maximus consequat. Nullam in nunc viverra, maximus orci id, pellentesque ante. Morbi quis blandit elit, quis tincidunt justoQuisque sit amet odio pellentesque, tempus nulla id, ultrices dolor. Ut porta magna nec dui congue sodales imperdiet non metus. In pharetra non lectus id ullamcorper. Praesent vel consectetur elit. Proin dignissim eleifend orci, vel vestibulum nunc malesuada et. Vivamus consectetur ipsum sed sapien tincidunt, a malesuada est elementum. Sed facilisis congue ante ut finibus. Donec tincidunt tortor in nisl auctor, ut facilisis nisl sagittis.')
            ->setInstitution($this->getReference('zpb-instit-9'));
        $manager->persist($faq23);

        $faq24 = new FAQ();
        $faq24->setQuestion('Commune 2 Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')
            ->setResponse('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')->setResponse('Nunc congue id lorem vitae fermentum. Curabitur et est finibus, sodales libero sed, vestibulum odio. Phasellus ac tellus ac lacus maximus consequat. Nullam in nunc viverra, maximus orci id, pellentesque ante. Morbi quis blandit elit, quis tincidunt justoQuisque sit amet odio pellentesque, tempus nulla id, ultrices dolor. Ut porta magna nec dui congue sodales imperdiet non metus. In pharetra non lectus id ullamcorper. Praesent vel consectetur elit. Proin dignissim eleifend orci, vel vestibulum nunc malesuada et. Vivamus consectetur ipsum sed sapien tincidunt, a malesuada est elementum. Sed facilisis congue ante ut finibus. Donec tincidunt tortor in nisl auctor, ut facilisis nisl sagittis.')
            ->setInstitution($this->getReference('zpb-instit-9'));
        $manager->persist($faq24);

        $faq25 = new FAQ();
        $faq25->setQuestion('Commune 3 Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')
            ->setResponse('Lorem ipsum dolor sit amet, consectetur adipiscing elit ?')->setResponse('Nunc congue id lorem vitae fermentum. Curabitur et est finibus, sodales libero sed, vestibulum odio. Phasellus ac tellus ac lacus maximus consequat. Nullam in nunc viverra, maximus orci id, pellentesque ante. Morbi quis blandit elit, quis tincidunt justoQuisque sit amet odio pellentesque, tempus nulla id, ultrices dolor. Ut porta magna nec dui congue sodales imperdiet non metus. In pharetra non lectus id ullamcorper. Praesent vel consectetur elit. Proin dignissim eleifend orci, vel vestibulum nunc malesuada et. Vivamus consectetur ipsum sed sapien tincidunt, a malesuada est elementum. Sed facilisis congue ante ut finibus. Donec tincidunt tortor in nisl auctor, ut facilisis nisl sagittis.')
            ->setInstitution($this->getReference('zpb-instit-9'));
        $manager->persist($faq25);



        $manager->flush();

        $this->addReference('zpb-faq-1', $faq1);
        $this->addReference('zpb-faq-2', $faq2);
        $this->addReference('zpb-faq-3', $faq3);
        $this->addReference('zpb-faq-4', $faq4);
        $this->addReference('zpb-faq-5', $faq5);
        $this->addReference('zpb-faq-6', $faq6);
        $this->addReference('zpb-faq-7', $faq7);
        $this->addReference('zpb-faq-8', $faq8);
        $this->addReference('zpb-faq-10', $faq10);
        $this->addReference('zpb-faq-11', $faq11);
        $this->addReference('zpb-faq-12', $faq12);
        $this->addReference('zpb-faq-13', $faq13);
        $this->addReference('zpb-faq-14', $faq14);
        $this->addReference('zpb-faq-15', $faq15);
        $this->addReference('zpb-faq-16', $faq16);
        $this->addReference('zpb-faq-17', $faq17);
        $this->addReference('zpb-faq-18', $faq18);
        $this->addReference('zpb-faq-19', $faq19);
        $this->addReference('zpb-faq-20', $faq20);
        $this->addReference('zpb-faq-21', $faq21);
        $this->addReference('zpb-faq-22', $faq22);
        $this->addReference('zpb-faq-23', $faq23);
        $this->addReference('zpb-faq-24', $faq24);
        $this->addReference('zpb-faq-25', $faq25);
    }

    public function getOrder()
    {
        return 75;
    }
}
