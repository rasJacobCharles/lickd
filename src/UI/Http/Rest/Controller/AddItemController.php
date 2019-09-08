<?php

declare(strict_types=1);

namespace App\UI\Http\Rest\Controller;

use App\Application\Basket\Command\AddSongCommand;

use App\Application\Basket\Command\AddSongHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/api/v1")
 */
class AddItemController extends AbstractController
{
    /**
     * @var AddSongHandler
     */
    private $handler;

    public function __construct(AddSongHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @Route("/add", name="add_item", methods={"POST"})
     */
    public function addSong(Request $request): Response
    {
        $basketId = $request->request->get('basketId') ?? $request->get('basketId', '');
        $songId = $request->request->get('songId') ?? $request->get('songId', '');
        $service = $this->handler;
        $service(new AddSongCommand($songId, $basketId));

        return new Response(sprintf('Song added %s', $basketId));
    }
}