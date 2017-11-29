<?php

namespace CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ParticipeRepository extends EntityRepository {

    public function getParticipe($l) {

        $qb = $this->createQueryBuilder('p')->leftJoin('p.idpartie', 'partie')
                ->addSelect('partie');

        /*$qb->where('p.idlogin != :idlogin')->setParameter('idlogin', $l)
                ->andWhere('partie.ouverte = :ouverte')->setParameter('ouverte', true)
                ->orderBy('p.idpartie', 'ASC');*/

        return $qb->getQuery()->getResult();
    }

}
