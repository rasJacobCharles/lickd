<?php

declare(strict_types=1);

namespace App\UI\Http\Rest\Controller;

use App\Application\Basket\Command\CreateBasketHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v1")
 */
class CreateBasketController extends AbstractController
{
    /**
     * @var CreateBasketHandler
     */
    private $handler;

    public function __construct(CreateBasketHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @Route("/basket", name="create_basker", methods={"POST"})
     */
    public function createBasket(): Response
    {
        $service = $this->handler;

        return new Response(sprintf('Basket ID: %s', $service()));
    }
}