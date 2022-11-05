<?php

namespace app\service;

use TelegramBot\Api\Exception;
use TelegramBot\Api\InvalidArgumentException;
use VK\Exceptions\Api\VKApiBlockedException;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;

class Handler extends Social
{
    /**
     * @var string
     */
    public string $groupId;

    /**
     * @var Vk
     */
    private Vk $vk;

    /**
     * @var FileHandler
     */
    private FileHandler $file;

    public function __construct ()
    {
        $this->vk   = $this->getVk();
        $this->file = $this->fileHandler();
    }

    /**
     * @return bool
     * @throws Exception
     * @throws InvalidArgumentException
     * @throws VKApiBlockedException
     * @throws VKApiException
     * @throws VKClientException
     */
    public function start (): bool
    {
        $post   = $this->vk->getPosts($this->groupId)->skipPinnedPost();
        $gameId = $this->file->setFilePath('game.json')->readFile();

        if ($post['id'] === $this->parseJson($gameId, true)['game_id']) {
            return false;
        }

        $this->notify($post);

        if (!$this->saveFile($post['id'])) { return false; }

        return true;
    }

    /**
     * @param array $post
     * @return void
     * @throws Exception
     * @throws InvalidArgumentException
     */
    private function notify (array $post): void
    {
        $this->getTelegram()->sendNotification(
            [1] // USER CHAT ID (may be array like [1, 2, 3])
            , $post['text']);
    }

    /**
     * @param int $postId
     * @return bool|int
     */
    private function saveFile (int $postId): bool|int
    {
        $params = [
            'game_id' => $postId
        ];

        return $this->file->saveFile($params);
    }
}
