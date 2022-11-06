# Free games parser from VKcom

A php mini-application for obtaining information about free Steam games, publication of data about this takes place on the VKontakte social network in the <a href="https://vk.com/freesteam">"Free steam"</a> community.
The community also announces free games in EpicGames, GOG.

## Installation & usage

Clone repository or download the source code, in **index.php** need to set group id
```php
$getGame = new Handler();
$getGame->groupId = 'GROUP_OR_USER_ID'; // Group id or user id, to get wall posts.
$getGame->start();
```

In **src\Service\Vk** need to set VK Api token, how to get it, may read this <a href="https://dev.vk.com/api/access-token/getting-started">documentation</a>

```php
private string $apiKey = 'VK_API_TOKEN';
```

To work with telegram, also need to provide BOT api token in **src\Service\Telegram**, which you may create and get from official telegram bot <a href="https://telegram.me/BotFather">@BotFather</a>

```php
private string $botApiToken = 'TELEGRAM_BOT_API_TOKEN';
```

Previous game id is saving in file game.json, you may replace it with Database if you need :)

In order for the bot to send a message, you must pass it the user IDs to whom the message will be sent in **src\Service\Handler**
```php
private function notify (array $post): void
{
    $this->getTelegram()->sendNotification(
        [1] // USER CHAT ID (may be array like [1, 2, 3])
        , $post['text']);
}
```

### Work process

Deploy the application somewhere on the server, follow all the previous steps and install crons on **index.php** (from 1-5 minutes) so as not to miss new games.

### Exceptions in use

May work only on Russians servers or with VPN

## License

The MIT License (MIT). Please see <a href="https://github.com/teh9/free-games-parser/blob/master/LICENSE">License File</a> for more information.
