<?php

namespace AppBundle\Repository;


class CategoriesRepository extends \Doctrine\ORM\EntityRepository
{
    public function finAllCategories()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM AppBundle:Categories c ORDER BY c.id ASC'
            )
            ->getResult();
    }
}
