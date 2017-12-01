<?php

namespace CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PartieRepository extends EntityRepository {

    function getPartieOuv() {

        $qb = $this->createQueryBuilder('p');
        $qb->where('p.ouverte = :ouverte')->setParameter('ouverte', true)
                ->orderBy('p.idpartie', 'ASC');

        return $qb->getQuery()->getResult();
    }

}
