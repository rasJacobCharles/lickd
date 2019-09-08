<?php

declare(strict_types=1);

namespace App\UI\Http\Rest\Controller;

use App\Application\Basket\Command\GetBasketCommand;
use App\Application\Item\Command\ListSongsHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/api/v1")
 */
class ListItemsController extends AbstractController
{
    /**
     * @var ListSongsHandler
     */
    private $handler;

    public function __construct(ListSongsHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @Route("/list", name="list_item", methods={"GET"})
     */
    public function list(): Response
    {
        $service = $this->handler;
        return new JsonResponse($service());
    }
}