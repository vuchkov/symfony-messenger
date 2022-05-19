<?php

namespace App\Message;

use App\Entity\ImagePost;

class AddPonkaToImage
{

    private int $imagePostId;

    public function __construct(int $imagePostId)
    {
        $this->imagePostId = $imagePostId;
    }

    public function getImagePostId(): int
    {
        return $this->imagePostId;
    }

}