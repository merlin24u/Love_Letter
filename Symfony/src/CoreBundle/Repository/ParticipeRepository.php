<?php

namespace CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ParticipeRepository extends EntityRepository {

    public function getParticipe($l) {
        $qb = $this->createQueryBuilder('p');
        $qb->where('p.idlogin = :idlogin')->setParameter('idlogin', $l);
        return $qb->getQuery()->getResult();
    }
    
    public function getPartie($p){
        $qb = $this->createQueryBuilder('p');
        $qb->where('p.idpartie = :idpartie')->setParameter('idpartie', $p);
        return $qb->getQuery()->getResult();
    }

}
