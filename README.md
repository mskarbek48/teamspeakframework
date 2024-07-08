
# TeamSpeak PHP Framework

This is a **PHP framework** for web and console applications that interact with the TeamSpeak 3 server query interface.

## Installation
* Install the package via composer:
```bash
composer require mskarbek48/teamspeakframework
```
## Features
* Access to all TeamSpeak 3 and TeamSpeak 5 server query commands.
* Event handling for default TeamSpeak "notifyevents" and custom events from logs.
* Compatibility with TeamSpeak 3 and TeamSpeak 5 servers.
* Compatibility with PHP 8.3 and higher.

## Tests
* To run the tests, you need to install the package via composer and run the following command:
```bash
php vendor/bin/phpunit
```
## Getting Started
* Connecting to TeamSpeak ServerQuery interface:
```php
<?php

use mskarbek48\TeamspeakFramework\TeamSpeak;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $TeamSpeak = TeamSpeak::factory()
        ->setHost('localhost')
        ->setPort(10011)
        ->connect();
} catch (\mskarbek48\TeamspeakFramework\Exception\TransportException $e) {
    echo $e->getMessage();
}
```
* To get ServerQuery instance and login:
```php
$instance = $TeamSpeak->getInstance();
$instance->login('username', 'password');
```
* To select server instance by port:
```php
$server = $instance->selectServerByPort(9987);
```
* To select server instance by id:
```php
$server = $instance->selectServerById(1);
```
* To listen for TeamSpeak events:
```php
$server->serverNotifyRegister('server');
$server->serverNotifyRegister('channel',0);
$server->serverNotifyRegister('textprivate');

while($server->getParent()->isConnected())
{
    if(time() - $server->getParent()->getLastExecutedCommandTime() > 60)
    {
        $server->getParent()->version(); # Prevent timeout
    }
    $event = $server->getParent()->waitForEvents(1); # Set to zero, to disable blocking
    switch(key($event)) {
        case "notifyclientmoved":
            echo "Client moved: " . $event['clid'] . " to " . $event['ctid'] . PHP_EOL;
            break;
    }
}
```
## Real life examples

```php
<?php

use mskarbek48\TeamspeakFramework\TeamSpeak;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $TeamSpeak = TeamSpeak::factory()
        ->setHost('localhost')
        ->setPort(10011)
        ->connect();
} catch (\mskarbek48\TeamspeakFramework\Exception\TransportException $e) {
    echo $e->getMessage();
}
$instance = $TeamSpeak->getInstance();
$instance->login('username', 'password');

$server = $instance->selectServerByPort(9987);


# Kick all clients from the server with a specific nickname:
foreach($server->clientList()->toAssocArray() as $client)
{
    if($client['client_nickname']== 'iwanttobekicked')
    {
        $server->clientKick($client['clid'], TeamSpeak::TEAMSPEAK_KICK_SERVER, 'Bye bye!');
    }
}
```


## License
This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
