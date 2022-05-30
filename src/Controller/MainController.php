<?php

namespace App\Controller;

use App\Message\Query\GetTotalImageCount;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage(MessageBusInterface $queryBus)
    {
        $envelope = $queryBus->dispatch(new GetTotalImageCount());

        /** @var HandledStamp $handled */
        $handled = $envelope->last(HandledStamp::class);
        $imageCount = $handled->getResult();

        return $this->render('main/homepage.html.twig', [
            'imageCount' => $imageCount
        ]);
    }
}