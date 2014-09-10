<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PostTargetRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostTargetRepository extends EntityRepository
{
    public function getFrontPost(PostTarget $target)
    {
        if ($target->getFrontPostId() != null) {
            $post = $this->_em->getRepository('ZPBAdminBundle:Post')->findOneByLongId($target->getFrontPostId());
        }

        return null;
    }
}
