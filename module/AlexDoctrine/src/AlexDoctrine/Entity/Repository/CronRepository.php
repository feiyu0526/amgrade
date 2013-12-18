<?php
namespace AlexDoctrine\Entity\Repository;

use Doctrine\ORM\EntityRepository;


class CronRepository extends EntityRepository
{
    public function findAllToArray ()
    {
        $dql = 'SELECT c FROM AlexDoctrine\Entity\Cron c ';

//        $dql = "SELECT b, e, r, p FROM \GraceDrops\Entity\User b JOIN b.engineer e ".
//               "JOIN b.reporter r JOIN b.products p ORDER BY b.created DESC";

        $query = $this->getEntityManager()->createQuery($dql);
        $result = $query->getArrayResult();
        return $result;
    }




//        $dql = "SELECT b, e, r, p FROM \GraceDrops\Entity\User b JOIN b.engineer e ".
//               "JOIN b.reporter r JOIN b.products p ORDER BY b.created DESC";
//        $query = $this->getEntityManager()->createQuery($dql);
//        $query->setMaxResults($number);
//        return $query->getArrayResult();
}

