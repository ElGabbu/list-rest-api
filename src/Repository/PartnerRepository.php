<?php
declare(strict_types=1);

namespace ListRestAPI\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class PartnerRepository extends EntityRepository
{
    /**
     * @param string $status
     * @param string $limit
     *
     * @return array
     */
    public function getSearchResults(string $status, string $limit): array
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->select()
            ->innerJoin('p.surveys', 's')
            ->groupBy('p.id')
            ->orderBy('p.id')
            ->setMaxResults($limit)
        ;
        $this->addWhereSurveyStatus($queryBuilder, $status);

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param QueryBuilder  $queryBuilder
     * @param string        $status
     * @param string        $alias
     *
     * @return QueryBuilder
     */
    private function addWhereSurveyStatus(QueryBuilder $queryBuilder, string $status, string $alias = 's'): QueryBuilder
    {
        return $queryBuilder
            ->andWhere(sprintf('%s.status = :status', $alias))
            ->setParameter('status', $status)
        ;
    }
}
