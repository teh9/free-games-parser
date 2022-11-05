<?php

namespace app\service;

use TelegramBot\Api\Exception;
use TelegramBot\Api\InvalidArgumentException;
use TelegramBot\Api\Types\Message;

class Telegram extends Social
{
    /**
     * @var string
     */
    private string $botApiToken = 'TELEGRAM_BOT_API_TOKEN';

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function sendNotification ($chatId, string $messageText): Message
    {
        return $this->telegramClient()->sendMessage(implode(',', $chatId), $messageText);
    }

    /**
     * @return string
     */
    public function getBotToken(): string
    {
        return $this->botApiToken;
    }
}
