<?php
declare(strict_types=1);

namespace ListRestAPI\Controller;

use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use ListRestAPI\Entity\Partner;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PartnerController extends FOSRestController
{
    /**
     * @FOSRest\Get("/partners")
     *
     * @param Request                $request
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function searchList(Request $request, EntityManagerInterface $entityManager): Response
    {
        $partners = $entityManager
            ->getRepository(Partner::class)
            ->getSearchResults($request->get('status'), $request->get('limit', '3'))
        ;

        $context = new Context();

        $view = $this->view(['data' => $partners], 200);
        $view->setContext($context);

        return $this->handleView($view);
    }
}
