<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 07/09/2014
 * Time: 18:51
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
use ZPB\AdminBundle\Entity\Post;

/**
 * Class LoadPosts
 * @package ZPB\AdminBundle\DataFixtures\ORM
 */
class LoadPosts  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container=null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $post1 = new Post();
        $post1
            ->setTitle('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
            ->setBody($this->text2.$this->text3)
            ->setExcerpt($this->text1)
            ->setCategory($this->getReference('zpb-post-cat-1'))
            ->addTarget($this->getReference('zpb-news-pt-1'))
            ->addTag($this->getReference('zpb-post-tag-1'));

        $manager->persist($post1);

        $post2 = new Post();
        $post2
            ->setTitle('Nullam varius vitae enim sit amet scelerisque. Vivamus ut libero vitae diam consectetur fringilla. Integer tempus feugiat tortor eu luctus.')
            ->setBody($this->text4.$this->text6.$this->text7)
            ->setExcerpt($this->text4)
            ->setCategory($this->getReference('zpb-post-cat-2'))
            ->addTarget($this->getReference('zpb-news-pt-1'))
            ->addTarget($this->getReference('zpb-news-pt-5'))
            ->addTag($this->getReference('zpb-post-tag-1'))
            ->addTag($this->getReference('zpb-post-tag-2'));

        $manager->persist($post2);


        $post3 = new Post();
        $post3
            ->setTitle('Nullam varius vitae enim sit amet scelerisque. Vivamus ut libero vitae diam consectetur fringilla. Integer tempus feugiat tortor eu luctus.')
            ->setBody($this->text6.$this->text8.$this->text9)
            ->setExcerpt($this->text5)
            ->setCategory($this->getReference('zpb-post-cat-5'))
            ->addTarget($this->getReference('zpb-news-pt-3'))
            ->addTarget($this->getReference('zpb-news-pt-2'))
            ->addTag($this->getReference('zpb-post-tag-3'))
            ->addTag($this->getReference('zpb-post-tag-4'));

        $manager->persist($post3);

        $post4 = new Post();
        $post4
            ->setTitle('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
            ->setBody($this->text2.$this->text3)
            ->setExcerpt($this->text1)
            ->setCategory($this->getReference('zpb-post-cat-1'))
            ->addTarget($this->getReference('zpb-news-pt-1'))
            ->addTag($this->getReference('zpb-post-tag-1'));


        $manager->persist($post4);

        $post5 = new Post();
        $post5
            ->setTitle('Varius vitae enim sit amet scelerisque. Integer tempus feugiat tortor eu luctus.')
            ->setBody($this->text4.$this->text6.$this->text7)
            ->setExcerpt($this->text4)
            ->setCategory($this->getReference('zpb-post-cat-2'))
            ->addTarget($this->getReference('zpb-news-pt-1'))
            ->addTarget($this->getReference('zpb-news-pt-5'))
            ->addTag($this->getReference('zpb-post-tag-1'))
            ->addTag($this->getReference('zpb-post-tag-2'));

        $manager->persist($post5);


        $post6 = new Post();
        $post6
            ->setTitle('Nullam varius vitae enim sit amet scelerisque. Vivamus ut libero vitae diam consectetur fringilla.')
            ->setBody($this->text6.$this->text8.$this->text9)
            ->setExcerpt($this->text5)
            ->setCategory($this->getReference('zpb-post-cat-5'))
            ->addTarget($this->getReference('zpb-news-pt-3'))
            ->addTarget($this->getReference('zpb-news-pt-2'))
            ->addTag($this->getReference('zpb-post-tag-3'))
            ->addTag($this->getReference('zpb-post-tag-4'));

        $manager->persist($post6);


        $manager->getRepository('ZPBAdminBundle:Post')->publish($post4);
        $manager->getRepository('ZPBAdminBundle:Post')->publish($post5);
        $manager->getRepository('ZPBAdminBundle:Post')->publish($post6);



        $manager->flush();
        $this->addReference('zpb-actu-1', $post1);
        $this->addReference('zpb-actu-2', $post2);
        $this->addReference('zpb-actu-3', $post3);
        $this->addReference('zpb-actu-4', $post4);
        $this->addReference('zpb-actu-5', $post5);
        $this->addReference('zpb-actu-6', $post6);

    }

    public function getOrder()
    {
        return 27;
    }

    private $text1 = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque posuere, lorem id faucibus euismod, dui ex tempor velit, vitae imperdiet erat purus vel tellus. Fusce sed turpis urna. Suspendisse ac velit eu erat molestie tempor ac vitae magna. Pellentesque ultricies ante sed nulla ultrices, eu scelerisque ex consequat.</p>';

    private $text2 = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque posuere, lorem id faucibus euismod, dui ex tempor velit, vitae imperdiet erat purus vel tellus. Fusce sed turpis urna. Suspendisse ac velit eu erat molestie tempor ac vitae magna. Pellentesque ultricies ante sed nulla ultrices, eu scelerisque ex consequat. Mauris tincidunt nibh eget lorem tempor porttitor. Nullam vestibulum nisi ante, vel semper enim ultrices in. Nam dictum sapien iaculis, tempor justo vel, ullamcorper arcu. Maecenas erat nisl, gravida a justo quis, congue egestas neque. Proin a semper mi. Suspendisse dictum maximus enim, in lobortis purus scelerisque sit amet. Curabitur libero dolor, laoreet a risus vel, convallis imperdiet neque. Proin et eros augue. Phasellus sodales sollicitudin odio, in malesuada lectus egestas sollicitudin. Vestibulum vel nisi et sapien commodo mattis. Sed sagittis fringilla libero, vel finibus urna convallis vel. </p>';

    private $text3 = '<p>Aliquam dictum nulla et gravida mollis. Morbi aliquet tellus nec ante aliquam porttitor. Nullam volutpat tempor risus, non rhoncus sem maximus et. Donec quis lacus sapien. Quisque sollicitudin ex tristique scelerisque pharetra. Suspendisse vel nunc nisl. Fusce vitae ipsum ipsum.</p>';

    private $text4 = '<p>Quisque ante leo, ultrices ac urna vel, accumsan varius est. Donec erat est, sodales in elit eget, tempor porta metus. Aenean volutpat, urna ut ornare mollis, sem dolor venenatis sem, ut mollis nibh diam id sem. Aliquam suscipit leo commodo mauris semper, eget volutpat libero convallis.</p>';

    private $text5 = '<p>Integer eget neque nibh. Phasellus id vehicula risus, at condimentum sapien. Aenean sodales lorem eros, a vestibulum tortor aliquet ut. Vestibulum ut dictum nisl, at ultrices sem. Aenean laoreet sagittis elit in mattis. Nullam leo turpis, tristique et venenatis rutrum, imperdiet ut risus.</p>';

    private $text6 = '<p>Sed id ante et magna convallis semper quis ac augue. Ut vel metus massa. Aenean sodales felis ligula, in scelerisque dui commodo quis. Aliquam feugiat neque a tempus faucibus. Quisque blandit malesuada sem a viverra. Quisque imperdiet in elit id tincidunt. Quisque nulla magna, tincidunt fermentum purus nec, rhoncus pulvinar magna.</p>';
    private $text7 = '<p>Mauris magna felis, dapibus sit amet iaculis vel, fringilla quis libero. Vivamus interdum nisl ligula, in pellentesque ante dapibus at. Nunc ac condimentum arcu. Nam libero lacus, rhoncus sit amet leo elementum, dictum fringilla lectus. Vivamus quis vulputate lectus. Phasellus vestibulum aliquam nisi, malesuada iaculis ex commodo vitae. Integer et ex a quam iaculis viverra non ut nibh. Praesent at est et dolor malesuada consectetur eu at lacus. Ut aliquam ligula ipsum, id auctor purus suscipit a. Aenean vitae est ligula. Aliquam sit amet ipsum ut eros aliquet iaculis. Maecenas lobortis nisl vel mauris accumsan, quis accumsan diam semper.</p>';
    private $text8 = '<p>Morbi a posuere enim. Proin vitae augue in nisl fringilla tempor. Vestibulum vitae pellentesque nisl. Phasellus facilisis nunc eget nunc ullamcorper feugiat. Etiam consectetur lacus id dui euismod vestibulum. Nam maximus tristique erat id aliquam. Nunc in tellus vitae enim dapibus dictum eu ac eros. </p>';
    private $text9 = '<p>Nullam in tempus mi, id aliquam dui. Sed viverra tellus vitae nulla sodales, vel imperdiet ligula aliquet. Pellentesque bibendum neque at quam malesuada tempor pharetra quis est. Curabitur in ligula nec orci feugiat placerat. Sed at ullamcorper neque. Vestibulum fringilla sapien eu nulla fringilla, nec semper nisi egestas. Nullam blandit pretium turpis laoreet vehicula. Pellentesque neque est, dignissim nec urna in, tempus ultricies erat. Nullam non urna turpis.</p>';


}
