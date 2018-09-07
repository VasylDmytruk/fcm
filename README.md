Firebase Cloud Messaging
========================
Sends push notification via Firebase Cloud Messaging Server

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist autoxloo/fcm "*"
```

or

```php
composer require --prefer-dist autoxloo/fcm "*"
```

or add

```
"autoxloo/fcm": "*"
```

to the require section of your `composer.json` file.

Usage
-----

To send push notification you should have private key file for your service account.

To generate a private key file for your service account:

1. In the Firebase console, open **Settings** > [Service Accounts](https://console.firebase.google.com/project/_/settings/serviceaccounts/adminsdk).
1. Click Generate New Private Key, and confirm by clicking Generate Key.

```php
$projectId = 'autoxloo';                                        // id of your project created in firebase console
$serviceAccountFilePath = __DIR__ . '/service_account.json';    // path to your generated private key file for your service account
```

Sending push notification:

```php
$fcm = new FirebaseCloudMessaging($projectId, $serviceAccountFilePath);
$response = $fcm->send($message);   // $message is instance of \autoxloo\fcm\message\Message
                                    // $response is instance of [\GuzzleHttp\Psr7\Response](https://github.com/guzzle/psr7/blob/master/src/Response.php)
```

Complete example:

```php
// initial data:
$projectId = 'autoxloo';
$serviceAccountFile = __DIR__ . '/service_account.json';
$token = 'some device token';
$name = 'Some name';
$title = 'Some title';
$body = 'Some body';
$data = [
    'some key1' => 'some value1',
    'some key2' => 'some value2',
]; 

// sending push notification:

$target = FCMFacade::createTargetToken($token);     // only target is required
$notification = FCMFacade::createNotification($title, $body);
$androidConfig = FCMFacade::createAndroidConfig([AndroidConfig::FIELD_PRIORITY => AndroidConfig::PRIORITY_HIGH]);

$message = FCMFacade::createMessage();
$message->setTarget($target)
    ->setName($name)
    ->setData($data)
    ->setNotification($notification)
    ->setAndroidConfig($androidConfig);

$fcm = new FirebaseCloudMessaging($projectId, $serviceAccountFile);
$response = $fcm->send($message);   // $response is instance of [\GuzzleHttp\Psr7\Response](https://github.com/guzzle/psr7/blob/master/src/Response.php)
```

Or

```php
$messageConfig = [
    // required one of: token, topic or condition
    Message::FIELD_TOKEN => $token,     // or Message::FIELD_TOPIC => $topic or Message::FIELD_CONDITION => $condition

    // not required values:
    Message::FIELD_NAME => $name,
    Message::FIELD_DATA => $data,
    Message::FIELD_NOTIFICATION => FCMFacade::createNotification($title, $body),
    Message::FIELD_ANDROID => FCMFacade::createAndroidConfig([
        AndroidConfig::FIELD_PRIORITY => AndroidConfig::PRIORITY_HIGH
   ]),
];

$message = FCMFacade::createMessage($messageConfig);

$fcm = new FirebaseCloudMessaging($projectId, $serviceAccountFile);
$response = $fcm->send($message);   // $response is instance of [\GuzzleHttp\Psr7\Response](https://github.com/guzzle/psr7/blob/master/src/Response.php)
```