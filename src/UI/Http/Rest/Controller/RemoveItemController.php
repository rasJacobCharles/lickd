<?php

declare(strict_types=1);

namespace App\UI\Http\Rest\Controller;

use App\Application\Basket\Command\AddSongCommand;
use App\Application\Basket\Command\RemoveSongCommand;
use App\Application\Basket\Command\RemoveSongHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v1")
 */
class RemoveItemController extends AbstractController
{
    /**
     * @var RemoveSongHandler
     */
    private $handler;

    public function __construct(RemoveSongHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @Route("/remove", name="remove_item", methods={"POST"})
     */
    public function addItem(Request $request): Response
    {
        $basketId = $request->request->get('basketId') ?? $request->get('basketId', '');
        $songId = $request->request->get('songId') ?? $request->get('songId', '');
        $service = $this->handler;
        $service(new RemoveSongCommand($songId, $basketId));

        return new Response(sprintf('Song remove %s', $basketId));
    }
}