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
            ->setBody("<p>" . $this->text2."</p>"."<p>" . $this->text3."</p>")
            ->setExcerpt($this->text1)
            ->setCategory($this->getReference('zpb-post-cat-1'))
            ->addTarget($this->getReference('zpb-news-pt-1'))
            ->addTag($this->getReference('zpb-post-tag-1'));

        $manager->persist($post1);

        $post2 = new Post();
        $post2
            ->setTitle('Nullam varius vitae enim sit amet scelerisque. Vivamus ut libero vitae diam consectetur fringilla. Integer tempus feugiat tortor eu luctus.')
            ->setBody("<p>".$this->text4."</p>"."<p>".$this->text6."</p>"."<p>".$this->text7."</p>")
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
            ->setBody("<p>".$this->text6."</p>"."<p>".$this->text8."</p>"."<p>".$this->text9."</p>")
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
            ->setBody("<p>".$this->text2."</p>"."<p>".$this->text3."</p>")
            ->setExcerpt($this->text1)
            ->setCategory($this->getReference('zpb-post-cat-1'))
            ->addTarget($this->getReference('zpb-news-pt-1'))
            ->addTag($this->getReference('zpb-post-tag-1'));


        $manager->persist($post4);

        $post5 = new Post();
        $post5
            ->setTitle('Varius vitae enim sit amet scelerisque. Integer tempus feugiat tortor eu luctus.')
            ->setBody("<p>".$this->text4."</p>"."<p>".$this->text6."</p>"."<p>".$this->text7."</p>")
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
            ->setBody("<p>".$this->text6."</p>"."<p>".$this->text8."</p>"."<p>".$this->text9."</p>")
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

    private $text1 = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aliquid, asperiores dolorum eaque est ipsa ipsum labore laboriosam laborum magnam nobis qui, quos sapiente velit vitae? Ad aliquid distinctio doloremque harum inventore ipsam reiciendis vel voluptatum? Animi atque dignissimos dolor magnam neque placeat quaerat voluptas, voluptatem. Aliquid atque cupiditate error eum explicabo hic id magni, minus modi molestias mollitia neque odit perferendis quaerat reprehenderit sed veritatis. Alias aliquam asperiores aut culpa dicta dolore dolorem ducimus eius eos error et fuga incidunt labore, magni minus neque nihil nisi nostrum placeat praesentium quidem quos rerum saepe temporibus vero vitae voluptatibus, voluptatum! Blanditiis consequuntur cumque ducimus officia omnis quam quibusdam sit suscipit unde vero. Assumenda consequatur dolores enim error ipsam, magni molestiae ratione. Accusamus aliquid asperiores at consequuntur dolorum eligendi esse eum expedita, hic incidunt ipsam iste iusto labore minima modi placeat recusandae rem repellendus reprehenderit repudiandae saepe sapiente tempora unde ut velit, veritatis voluptate voluptatibus. Aliquam, amet asperiores assumenda cum dicta dolorum eligendi eos facere facilis harum incidunt laborum, magni, omnis quaerat veniam vero voluptas! Aliquid aperiam ducimus fugiat ratione similique? Ab ad assumenda atque consectetur debitis eos, impedit in laudantium nisi officia omnis perferendis quibusdam quidem quisquam ratione repellat, sequi voluptatibus.';

    private $text2 = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aliquid, asperiores dolorum eaque est ipsa ipsum labore laboriosam laborum magnam nobis qui, quos sapiente velit vitae? Ad aliquid distinctio doloremque harum inventore ipsam reiciendis vel voluptatum? Animi atque dignissimos dolor magnam neque placeat quaerat voluptas, voluptatem. Aliquid atque cupiditate error eum explicabo hic id magni, minus modi molestias mollitia neque odit perferendis quaerat reprehenderit sed veritatis. Alias aliquam asperiores aut culpa dicta dolore dolorem ducimus eius eos error et fuga incidunt labore, magni minus neque nihil nisi nostrum placeat praesentium quidem quos rerum saepe temporibus vero vitae voluptatibus, voluptatum! Blanditiis consequuntur cumque ducimus officia omnis quam quibusdam sit suscipit unde vero. Assumenda consequatur dolores enim error ipsam, magni molestiae ratione. Accusamus aliquid asperiores at consequuntur dolorum eligendi esse eum expedita, hic incidunt ipsam iste iusto labore minima modi placeat recusandae rem repellendus reprehenderit repudiandae saepe sapiente tempora unde ut velit, veritatis voluptate voluptatibus. Aliquam, amet asperiores assumenda cum dicta dolorum eligendi eos facere facilis harum incidunt laborum, magni, omnis quaerat veniam vero voluptas! Aliquid aperiam ducimus fugiat ratione similique? Ab ad assumenda atque consectetur debitis eos.';

    private $text3 = ' Ad aliquid distinctio doloremque harum inventore ipsam reiciendis vel voluptatum? Animi atque dignissimos dolor magnam neque placeat quaerat voluptas, voluptatem. Aliquid atque cupiditate error eum explicabo hic id magni, minus modi molestias mollitia neque odit perferendis quaerat reprehenderit sed veritatis. Alias aliquam asperiores aut culpa dicta dolore dolorem ducimus eius eos error et fuga incidunt labore, magni minus neque nihil nisi nostrum placeat praesentium quidem quos rerum saepe temporibus vero vitae voluptatibus, voluptatum! Blanditiis consequuntur cumque ducimus officia omnis quam quibusdam sit suscipit unde vero. Assumenda consequatur dolores enim error ipsam, magni molestiae ratione. Accusamus aliquid asperiores at consequuntur dolorum eligendi esse eum expedita, hic incidunt ipsam iste iusto labore minima modi placeat recusandae rem repellendus reprehenderit repudiandae saepe sapiente tempora unde ut velit, veritatis voluptate voluptatibus. Aliquam, amet asperiores assumenda cum dicta dolorum eligendi eos facere facilis harum incidunt laborum, magni, omnis quaerat veniam vero voluptas! Aliquid aperiam ducimus fugiat ratione similique? Ab ad assumenda atque consectetur debitis eos, impedit in laudantium nisi officia omnis perferendis quibusdam quidem quisquam ratione repellat, sequi voluptatibus.';

    private $text4 = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aliquid, asperiores dolorum eaque est ipsa ipsum labore laboriosam laborum magnam nobis qui, quos sapiente velit vitae? Ad aliquid distinctio doloremque harum inventore ipsam reiciendis vel voluptatum? Animi atque dignissimos dolor magnam neque placeat quaerat voluptas, voluptatem. Aliquid atque cupiditate error eum explicabo hic id magni, minus modi molestias mollitia neque odit perferendis quaerat reprehenderit sed veritatis. Alias aliquam asperiores aut culpa dicta dolore dolorem ducimus eius eos error et fuga incidunt labore, magni minus neque nihil nisi nostrum placeat praesentium quidem quos rerum saepe temporibus vero vitae voluptatibus, voluptatum! Blanditiis consequuntur cumque ducimus officia omnis quam quibusdam sit suscipit unde vero. Assumenda consequatur dolores enim error ipsam, magni molestiae ratione. Accusamus aliquid asperiores at consequuntur dolorum eligendi esse eum expedita, hic incidunt ipsam iste iusto labore minima modi placeat recusandae rem repellendus reprehenderit repudiandae saepe sapiente tempora unde ut velit, veritatis voluptate voluptatibus. Aliquam, amet asperiores assumenda cum dicta dolorum eligendi eos facere facilis harum incidunt laborum, magni, omnis quaerat veniam vero voluptas! Aliquid aperiam ducimus fugiat ratione similique? ';

    private $text5 = 'Ab aliquid, asperiores dolorum eaque est ipsa ipsum labore laboriosam laborum magnam nobis qui, quos sapiente velit vitae? Ad aliquid distinctio doloremque harum inventore ipsam reiciendis vel voluptatum? Animi atque dignissimos dolor magnam neque placeat quaerat voluptas, voluptatem. Aliquid atque cupiditate error eum explicabo hic id magni, minus modi molestias mollitia neque odit perferendis quaerat reprehenderit sed veritatis. Alias aliquam asperiores aut culpa dicta dolore dolorem ducimus eius eos error et fuga incidunt labore, magni minus neque nihil nisi nostrum placeat praesentium quidem quos rerum saepe temporibus vero vitae voluptatibus, voluptatum! Blanditiis consequuntur cumque ducimus officia omnis quam quibusdam sit suscipit unde vero. Assumenda consequatur dolores enim error ipsam, magni molestiae ratione. Accusamus aliquid asperiores at consequuntur dolorum eligendi esse eum expedita, hic incidunt ipsam iste iusto labore minima modi placeat recusandae rem repellendus reprehenderit repudiandae saepe sapiente tempora unde ut velit, veritatis voluptate voluptatibus. Aliquam, amet asperiores assumenda cum dicta dolorum eligendi eos facere facilis harum incidunt laborum, magni, omnis quaerat veniam vero voluptas! Aliquid aperiam ducimus fugiat ratione similique? Ab ad assumenda atque consectetur debitis eos.';

    private $text6 = 'Sed id ante et magna convallis semper quis ac augue. Ut vel metus massa. Aenean sodales felis ligula, in scelerisque dui commodo quis. Aliquam feugiat neque a tempus faucibus. Quisque blandit malesuada sem a viverra. Quisque imperdiet in elit id tincidunt. Quisque nulla magna, tincidunt fermentum purus nec, rhoncus pulvinar magna.';
    private $text7 = 'Mauris magna felis, dapibus sit amet iaculis vel, fringilla quis libero. Vivamus interdum nisl ligula, in pellentesque ante dapibus at. Nunc ac condimentum arcu. Nam libero lacus, rhoncus sit amet leo elementum, dictum fringilla lectus. Vivamus quis vulputate lectus. Phasellus vestibulum aliquam nisi, malesuada iaculis ex commodo vitae. Integer et ex a quam iaculis viverra non ut nibh. Praesent at est et dolor malesuada consectetur eu at lacus. Ut aliquam ligula ipsum, id auctor purus suscipit a. Aenean vitae est ligula. Aliquam sit amet ipsum ut eros aliquet iaculis. Maecenas lobortis nisl vel mauris accumsan, quis accumsan diam semper.';
    private $text8 = 'Morbi a posuere enim. Proin vitae augue in nisl fringilla tempor. Vestibulum vitae pellentesque nisl. Phasellus facilisis nunc eget nunc ullamcorper feugiat. Etiam consectetur lacus id dui euismod vestibulum. Nam maximus tristique erat id aliquam. Nunc in tellus vitae enim dapibus dictum eu ac eros. ';
    private $text9 = 'Nullam in tempus mi, id aliquam dui. Sed viverra tellus vitae nulla sodales, vel imperdiet ligula aliquet. Pellentesque bibendum neque at quam malesuada tempor pharetra quis est. Curabitur in ligula nec orci feugiat placerat. Sed at ullamcorper neque. Vestibulum fringilla sapien eu nulla fringilla, nec semper nisi egestas. Nullam blandit pretium turpis laoreet vehicula. Pellentesque neque est, dignissim nec urna in, tempus ultricies erat. Nullam non urna turpis.';


}
