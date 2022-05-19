<?php

namespace App\MessageHandler;

use App\Message\DeleteImagePost;
use App\Photo\PhotoFileManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Validator\Tests\Fixtures\Entity;

class DeleteImagePostHandler implements MessageHandlerInterface
{

    private PhotoFileManager $photoManager;
    private EntityManager $entityManager;

    public function __construct(PhotoFileManager $photoManager, EntityManager $entityManager)
    {
        $this->photoManager = $photoManager;
        $this->entityManager = $entityManager;
    }

    public function __invoke(DeleteImagePost $deleteImagePost)
    {
        $imagePost = $deleteImagePost->getImagePost();
        $this->photoManager->deleteImage($imagePost->getFilename());

        $this->entityManager->remove($imagePost);
        $this->entityManager->flush();
    }

}