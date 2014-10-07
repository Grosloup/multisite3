<?php

namespace ZPB\AdminBundle\Entity;


use Gedmo\Sortable\Entity\Repository\SortableRepository;

/**
 * SponsoringGiftDefinitionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SponsoringGiftDefinitionRepository extends SortableRepository
{
    public function getSortedResult()
    {
        return $this->getBySortableGroupsQuery(['positionGroup'=>'sponsoring-gifts'])->getResult();
    }
}
