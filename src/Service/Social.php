<?php

namespace app\Service;

use Teh9\TelegramPhpSdk\Telegram\Client\TelegramApiClient;
use VK\Client\VKApiClient;

abstract class Social
{
    /**
     * @param string $jsonData
     * @param bool $toArray
     * @return object|array
     */
    public function parseJson (string $jsonData, bool $toArray = false): object|array
    {
        return json_decode($jsonData, $toArray);
    }

    /**
     * @return VKApiClient
     */
    protected function vkClient (): VKApiClient
    {
        return new VKApiClient();
    }

    /**
     * @return FileHandler
     */
    protected function fileHandler (): FileHandler
    {
        return new FileHandler();
    }

    /**
     * @return Vk
     */
    protected function getVk (): Vk
    {
        return new Vk();
    }

    /**
     * @return TelegramApiClient
     */
    protected function telegramClient (): TelegramApiClient
    {
        return new TelegramApiClient();
    }

    /**
     * @return Telegram
     */
    protected function getTelegram ()
    {
        return new Telegram();
    }
}
