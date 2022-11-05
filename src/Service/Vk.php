<?php

namespace app\service;

use VK\Exceptions\Api\VKApiBlockedException;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;

class Vk extends Social
{
    /**
     * @var array
     */
    public array $items = [];

    /**
     * @var string
     */
    private string $apiKey = 'VK_API_TOKEN';

    /**
     * @throws VKApiBlockedException
     * @throws VKApiException
     * @throws VKClientException
     */
    public function getPosts (string $ownerId): static
    {
        $params = [
            'owner_id' => $ownerId,
            'count'    => 5
        ];

        $this->items = $this->vkClient()->wall()->get($this->apiKey, $params)['items'];

        return $this;
    }

    /**
     * Returning wall pinned post (if pinned post not exist anyway will return 0 (first post)).
     *
     * @return bool
     */
    public function getFirstOrPinnedPost (): bool
    {
        return $this->items[0];
    }

    /**
     * Skipping wall pinned post and return next one.
     *
     * @return array
     */
    public function skipPinnedPost (): array
    {
        return isset($this->items[0]['is_pinned']) ? $this->items[1] : $this->items[0];
    }
}
