<?php

namespace App\Message;

use App\Entity\ImagePost;

class DeleteImagePost
{

    private ImagePost $imagePost;

    public function __construct(ImagePost $imagePost)
    {
        $this->imagePost = $imagePost;
    }

    public function getImagePost(): ImagePost
    {
        $this->imagePost;
    }

}