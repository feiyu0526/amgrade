<?php
namespace AlexDoctrine\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class GoodsRepository extends EntityRepository
{

    /**
     *get all data as array
     * @return type array
     */
    public function findAllToArray ()
    {
        $dql = 'SELECT u FROM AlexDoctrine\Entity\Goods u ';
        $query = $this->getEntityManager()->createQuery($dql);
        $result = $query->getArrayResult();
        return $result;
    }

}

