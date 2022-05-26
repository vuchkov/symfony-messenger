<?php

namespace App\MessageHandler\Command;

use App\Message\Command\AddPonkaToImage;
use App\Photo\PhotoFileManager;
use App\Photo\PhotoPonkaficator;
use App\Repository\ImagePostRepository;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AddPonkaToImageHandler implements MessageHandlerInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    private $ponkaficator;
    private $photoManager;
    private $entityManager;
    private $imagePostRepository;

    public function __construct(PhotoPonkaficator $ponkaficator, PhotoFileManager $photoManager, EntityManager $entityManager, ImagePostRepository $imagePostRepository)
    {
        $this->ponkaficator = $ponkaficator;
        $this->photoManager = $photoManager;
        $this->entityManager = $entityManager;
        $this->imagePostRepository = $imagePostRepository;
    }

    public function __invoke(AddPonkaToImage $addPonkaToImage)
    {
        $imagePostId = $addPonkaToImage->getImagePostId();
        $imagePost = $this->imagePostRepository->find($imagePostId);

        if (!$imagePost) {
            if ($this->logger) {
                $this->logger->alert(sprintf('Image post %d was missing!', $imagePostId));
            }
        }

        $updatedContents = $this->ponkaficator->ponkafy(
              $this->photoManager->read($imagePost->getFilename())
        );
        $this->photoManager->update($imagePost->getFilename(), $updatedContents);
        $imagePost->markAsPonkaAdded();
        $this->entityManager->flush();
    }

}