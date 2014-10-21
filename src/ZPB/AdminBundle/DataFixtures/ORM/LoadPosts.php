<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 21/10/2014
 * Time: 16:26
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

namespace ZPB\AdminBundle\Datafixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use ZPB\AdminBundle\Entity\Post;

class LoadPosts extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
    * @var \Symfony\Component\DependencyInjection\ContainerInterface
    */
    private $container;

    public function setContainer(ContainerInterface $container=null)
    {
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager)
    {
        $post1 = new Post();
        $post1->setTitle('Lorem ipsum dolor sit amet')->setBody($this->getBody(0))
            ->setExcerpt('Suspendisse eleifend augue id arcu blandit, in tempus dui posuere. Sed scelerisque suscipit arcu quis mollis.');
        $manager->persist($post1);

        $post2 = new Post();
        $post2->setTitle('Vestibulum in urn')->setBody($this->getBody(1))
            ->setExcerpt('Phasellus congue cursus ex, vel mattis nulla maximus sit amet.');
        $manager->persist($post2);

        $post3 = new Post();
        $post3->setTitle('Fusce quis congue nisi')->setBody($this->getBody(2))
            ->setExcerpt(' Ut suscipit ante id ligula facilisis dignissim. Morbi rhoncus tortor sed arcu molestie dapibus.');
        $manager->persist($post3);

        $post4 = new Post();
        $post4->setTitle('Sed commodo quam ac')->setBody($this->getBody(3))
            ->setExcerpt('Suspendisse at viverra dui, vel euismod risus. Morbi sapien nulla, ornare ut tempor ut, sodales vitae arcu.');
        $manager->persist($post4);

        $post5 = new Post();
        $post5->setTitle('Cras tortor augue')->setBody($this->getBody(4))
            ->setExcerpt('Proin id erat ut orci ornare bibendum sit amet ut mi. Suspendisse sollicitudin facilisis tristique. Pellentesque a enim nec odio sollicitudin faucibus. ');
        $manager->persist($post5);

        $post6 = new Post();
        $post6->setTitle('Suspendisse condimentum ant')->setBody($this->getBody(5))
            ->setExcerpt('Nulla ut lorem accumsan, rhoncus nunc a, suscipit ipsum. Suspendisse accumsan arcu magna, eu mollis sem pretium congue.');
        $manager->persist($post6);


        $manager->flush();
        $this->addReference('zpb-actu-draft-1', $post1);
        $this->addReference('zpb-actu-draft-2', $post2);
        $this->addReference('zpb-actu-draft-3', $post3);
        $this->addReference('zpb-actu-draft-4', $post4);
        $this->addReference('zpb-actu-draft-5', $post5);
        $this->addReference('zpb-actu-draft-6', $post6);
    }
    
    public function getOrder()
    {
        return 27;
    }

    private function getBody($num)
    {
        $body = [
            '<p>Cras tortor augue, dignissim eget odio ac, tincidunt rutrum nisl. Proin nec ex justo. Quisque lobortis, neque vitae accumsan tristique, ante lacus interdum nisl, quis efficitur quam ex interdum ligula. Proin egestas felis in leo consequat, a feugiat nisl placerat.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in urna consectetur, lobortis metus at, venenatis libero. Fusce quis congue nisi, quis auctor lorem. </p><p>Sed commodo quam ac turpis dignissim mattis. Etiam at elit imperdiet dui imperdiet pulvinar et ac enim.</p>',
            '<p>Aliquam tellus lectus, vehicula ut mauris a, viverra viverra ante. Aenean accumsan urna ut nisl luctus, in porta elit convallis. Suspendisse urna purus, mattis ac mi nec, imperdiet hendrerit odio. Suspendisse suscipit, diam et placerat laoreet, odio ex consectetur tortor, sit amet cursus purus quam sed quam. Duis commodo nisi justo, auctor pulvinar erat sodales hendrerit. </p><p>Nulla ut lorem accumsan, rhoncus nunc a, suscipit ipsum. Suspendisse accumsan arcu magna, eu mollis sem pretium congue. Pellentesque sed feugiat ipsum. Nulla pretium dictum fringilla. Phasellus fermentum tincidunt ornare. Phasellus euismod ante vel gravida molestie.</p><p>Ut suscipit ante id ligula facilisis dignissim. Morbi rhoncus tortor sed arcu molestie dapibus. Suspendisse at viverra dui, vel euismod risus. Morbi sapien nulla, ornare ut tempor ut, sodales vitae arcu. Proin id erat ut orci ornare bibendum sit amet ut mi. Suspendisse sollicitudin facilisis tristique. Pellentesque a enim nec odio sollicitudin faucibus. </p>',
            '<p>Phasellus congue cursus ex, vel mattis nulla maximus sit amet. Vivamus arcu neque, pellentesque vitae massa nec, pharetra luctus turpis. Ut suscipit ante id ligula facilisis dignissim. Morbi rhoncus tortor sed arcu molestie dapibus. Suspendisse at viverra dui, vel euismod risus.</p><p>Suspendisse eleifend augue id arcu blandit, in tempus dui posuere. Sed scelerisque suscipit arcu quis mollis. Curabitur vel augue vitae lacus iaculis hendrerit. Phasellus congue cursus ex, vel mattis nulla maximus sit amet. Vivamus arcu neque, pellentesque vitae massa nec, pharetra luctus turpis.</p><p>Suspendisse eleifend augue id arcu blandit, in tempus dui posuere. Sed scelerisque suscipit arcu quis mollis. Curabitur vel augue vitae lacus iaculis hendrerit. Phasellus congue cursus ex, vel mattis nulla maximus sit amet. Vivamus arcu neque, pellentesque vitae massa nec, pharetra luctus turpis.</p>',
            '<p>Phasellus eget dolor faucibus, imperdiet felis sit amet, iaculis justo. Cras sed nunc ac elit suscipit convallis at non ante. Mauris sed interdum diam. Maecenas egestas commodo augue, eu ultrices felis placerat tincidunt. Proin maximus, eros malesuada auctor lacinia, turpis tellus hendrerit ex, et tincidunt purus elit at felis.</p><p>In ornare mattis dictum. Proin purus velit, maximus in tellus nec, venenatis euismod risus. Aliquam nec finibus diam. Sed non vulputate est. Morbi vel ipsum ut ex placerat finibus eu a sapien. Aenean mattis turpis pretium massa ultrices vulputate. Cras sem urna, suscipit ac nisi eget, molestie porta orci.</p><p>Nunc hendrerit porttitor sem, in vestibulum nunc imperdiet ut. Suspendisse lobortis placerat dolor, vel facilisis elit sodales vitae. Aliquam tellus lectus, vehicula ut mauris a, viverra viverra ante. Aenean accumsan urna ut nisl luctus, in porta elit convallis. Suspendisse urna purus, mattis ac mi nec, imperdiet hendrerit odio. </p>',
            '<p>Nulla ut lorem accumsan, rhoncus nunc a, suscipit ipsum. Suspendisse accumsan arcu magna, eu mollis sem pretium congue. Pellentesque sed feugiat ipsum. Nulla pretium dictum fringilla. Phasellus fermentum tincidunt ornare. Phasellus euismod ante vel gravida molestie.</p><p>Suspendisse suscipit, diam et placerat laoreet, odio ex consectetur tortor, sit amet cursus purus quam sed quam. Duis commodo nisi justo, auctor pulvinar erat sodales hendrerit.</p><p>Suspendisse condimentum ante ut dui pellentesque, ut accumsan velit malesuada. Sed volutpat tempor tortor, quis porta arcu rhoncus a. Aenean bibendum, tellus in ullamcorper dapibus, tortor libero varius mauris, vel pharetra libero ligula at nisi. Aenean non placerat diam, in fermentum eros.</p>',
            '<p>Ut suscipit ante id ligula facilisis dignissim. Morbi rhoncus tortor sed arcu molestie dapibus. Suspendisse at viverra dui, vel euismod risus. Morbi sapien nulla, ornare ut tempor ut, sodales vitae arcu. Proin id erat ut orci ornare bibendum sit amet ut mi. Suspendisse sollicitudin facilisis tristique. Pellentesque a enim nec odio sollicitudin faucibus. </p><p>Suspendisse suscipit, diam et placerat laoreet, odio ex consectetur tortor, sit amet cursus purus quam sed quam. Duis commodo nisi justo, auctor pulvinar erat sodales hendrerit.</p><p>Cras tortor augue, dignissim eget odio ac, tincidunt rutrum nisl. Proin nec ex justo. Quisque lobortis, neque vitae accumsan tristique, ante lacus interdum nisl, quis efficitur quam ex interdum ligula. Proin egestas felis in leo consequat, a feugiat nisl placerat.</p>'
        ];
        return $body[$num];
    }
}
