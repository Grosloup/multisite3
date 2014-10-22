<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PublishedPostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PublishedPostRepository extends EntityRepository
{
    public function getByTarget($target)
    {
        $qb = $this->createQueryBuilder('p')->where('p.target= :target')->andWhere('p.isArchived = :isArchived')->orderBy('p.publishedAt', 'ASC');
        $qb->setParameter('target', $target)->setParameter('isArchived',false);
        return $qb->getQuery()->getResult();

        /*$q = $this->_em->createQuery(
            'SELECT pp FROM ZPBAdminBundle:PublishedPost pp JOIN ZPBAdminBundle:Post p WHERE pp.postId = p.id AND pp.target= :target AND pp.isArchived = :isArchived ORDER BY pp.publishedAt ASC'
        );*/
        /*$q = $this->_em->createQuery(
            'SELECT pp, p FROM ZPBAdminBundle:PublishedPost pp , ZPBAdminBundle:Post p WHERE pp.postId = p.id AND pp.target= :target AND pp.isArchived = :isArchived ORDER BY pp.publishedAt ASC'
        );*/


    }

    public function getBySlug($slug, $target)
    {
        /*$q = $this->_em->createQuery(
            'SELECT pp FROM ZPBAdminBundle:PublishedPost pp JOIN ZPBAdminBundle:Post p WHERE p.slug = :slug AND pp.target= :target AND pp.isArchived = :isArchived ORDER BY pp.publishedAt ASC'
        );*/
        $qb = $this->createQueryBuilder('p')->select('p, post')->join('p.post', 'post')->where('p.target= :target')->andWhere('p.isArchived = :isArchived')->andWhere('post.slug = :slug')->orderBy('p.publishedAt', 'ASC');
        $qb->setParameter('slug', $slug);
        $qb->setParameter('target', $target);
        $qb->setParameter('isArchived', false);

        return $qb->getQuery()->getSingleResult();
    }
}
