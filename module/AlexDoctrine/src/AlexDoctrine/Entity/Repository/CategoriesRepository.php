<?php
namespace AlexDoctrine\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class CategoriesRepository extends EntityRepository
{
    /**
     *get all data as array
     * @return type array
     */
    public function findAllToArray ()
    {
        $dql = 'SELECT u FROM AlexDoctrine\Entity\Categories u ';
        $query = $this->getEntityManager()->createQuery($dql);
        $result = $query->getArrayResult();
        return $result;
    }


    public function reBuildCategoriesArrForSelectElement($categoriesArr)
    {
        $returnArr = array();
        if ( ! empty($categoriesArr) )
        {

            foreach ($categoriesArr as $key => $oneCat)
            {
                $returnArr[$oneCat['category']] = $oneCat['category'];
            }

        }
        return $returnArr;
    }

}

