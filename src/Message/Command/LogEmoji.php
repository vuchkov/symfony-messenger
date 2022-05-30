<?php

namespace App\Message\Command;

class LogEmoji
{
    private $emojiIndex;

    public function __construct(int $emojiIndex)
    {
        $this->emojiIndex = $emojiIndex;
    }

    public function getEmojiIndex(): int
    {
        return $this->emojiIndex;
    }
}
