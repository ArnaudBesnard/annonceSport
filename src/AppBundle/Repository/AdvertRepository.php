<?php

namespace AppBundle\Repository;

class AdvertRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllAdverts()
    {
        return $this
            ->createQueryBuilder('a')
                ->select('COUNT(a.id)')
                ->where('a.published = :published')->setParameter('published', 1)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
