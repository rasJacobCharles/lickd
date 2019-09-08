<?php

declare(strict_types=1);

namespace App\UI\Http\Rest\Controller;


use App\Application\Basket\Command\GetBasketCommand;
use App\Application\Basket\Command\GetBasketHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v1")
 */
class ViewBasketController extends AbstractController
{
    /**
     * @var GetBasketHandler
     */
    private $handler;

    public function __construct(GetBasketHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @Route("/basket/{basketId}", name="view_basket", methods={"GET"})
     */
    public function list(string $basketId = ''): Response
    {
        $service = $this->handler;
        return new JsonResponse($service(new GetBasketCommand($basketId)));
    }
}