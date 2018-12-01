<?php
declare(strict_types=1);

namespace ListRestAPI\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class PartnerRepository extends EntityRepository
{
    /**
     * @param string $status
     *
     * @return array
     */
    public function getSearchResults(string $status): array
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->select()
            ->innerJoin('p.surveys', 's')
            ->groupBy('p.id')
            ->orderBy('p.id')
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
        // If no status parameter has been specified or the value of the parameter is neither active or inactive apply no filtration logic
        if(!$status || !in_array($status, ['active', 'inactive'])) {
            return $queryBuilder;
        }

        // Refactored to base the filtration on the openAt and closeAt fields such that the filtration is more reliable
        if($status == 'active') {
            return $queryBuilder
                ->andWhere(sprintf('%s.openAt <= \'%s\'', $alias, date('Y-m-d H:i:s')))
                ->andWhere(sprintf('%s.closeAt >= \'%s\'', $alias, date('Y-m-d H:i:s')));
        } else {
            return $queryBuilder
                ->orWhere(sprintf('%s.openAt >= \'%s\'', $alias, date('Y-m-d H:i:s')))
                ->orWhere(sprintf('%s.closeAt <= \'%s\'', $alias, date('Y-m-d H:i:s')));
        }
    }
}
