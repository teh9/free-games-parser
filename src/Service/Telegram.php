<?php

namespace app\Service;

use Teh9\TelegramPhpSdk\Telegram\Exceptions\TelegramClientException;

class Telegram extends Social
{
    /**
     * @var string
     */
    private string $botApiToken = 'TELEGRAM_BOT_API_TOKEN';

    /**
     * @param $chatId
     * @param string $messageText
     * @return array
     * @throws TelegramClientException
     */
    public function sendNotification ($chatId, string $messageText): array
    {
        return $this->telegramClient()->messages()->send($this->botApiToken, [
            'chat_id' => implode(',', $chatId),
            'text'    => $messageText
        ]);
    }
}
