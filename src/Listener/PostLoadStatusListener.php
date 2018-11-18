<?php
declare(strict_types=1);

namespace ListRestAPI\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use ListRestAPI\Entity\Partner;
use ListRestAPI\Entity\Survey;

class PostLoadStatusListener
{
    /**
     * @param LifecycleEventArgs $args
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function postLoad(LifecycleEventArgs $args): void
    {
        $partner = $args->getEntity();
        if (!$partner instanceof Partner) {
            return;
        }

        $entityManager = $args->getEntityManager();

        /** @var Survey $survey */
        foreach ($partner->getSurveys() as $survey) {
            if (!$this->hasPastCloseDate($survey)) {
                continue;
            }

            $survey->setStatus('inactive');
            $entityManager->persist($survey);
        }

        $entityManager->flush();
    }

    /**
     * @param Survey $survey
     *
     * @return bool
     */
    private function hasPastCloseDate(Survey $survey): bool
    {
        return (new \DateTime()) >= $survey->getCloseAt();
    }
}
