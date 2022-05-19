<?php

namespace App\MessageHandler;

use App\Message\AddPonkaToImage;
use App\Photo\PhotoFileManager;
use App\Photo\PhotoPonkaficator;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AddPonkaToImageHandler implements MessageHandlerInterface
{

    private PhotoPonkaficator $ponkaficator;
    private PhotoFileManager $photoManager;
    private EntityManager $entityManager;

    public function __construct(PhotoPonkaficator $ponkaficator, PhotoFileManager $photoManager, EntityManager $entityManager)
    {
        $this->ponkaficator = $ponkaficator;
        $this->photoManager = $photoManager;
        $this->entityManager = $entityManager;
    }

    public function __invoke(AddPonkaToImage $addPonkaToImage)
    {
        $imagePost = $addPonkaToImage->getImagePost();

        $updatedContents = $this->ponkaficator->ponkafy(
              $this->photoManager->read($imagePost->getFilename())
        );
        $this->photoManager->update($imagePost->getFilename(), $updatedContents);
        $imagePost->markAsPonkaAdded();
        $this->entityManager->flush();
    }

}