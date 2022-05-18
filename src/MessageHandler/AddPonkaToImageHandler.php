<?php

namespace App\MessageHandler;

use App\Message\AddPonkaToImage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AddPonkaToImageHandler implements MessageHandlerInterface
{

    public function __invoke(AddPonkaToImage $addPonkaToImage)
    {
        dump($addPonkaToImage);
    }

}