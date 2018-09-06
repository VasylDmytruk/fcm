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
$response = $fcm->send($message);   // $response is instance of \GuzzleHttp\Psr7\Response
```

Example of `$message` array:

```php
$message = [
    'message' => [
        'token' => 'fJKJAqP7LYw:APA91bEcbgWvOAxj',  // device token
        'notification' => [
            'title' => 'Some title',
            'body' => 'Some body',
        ],
        'data' => [
            'someKey' => 'SomeValue',
        ],
        'android' => [
            'priority' => 'NORMAL',                 // or 'HIGH'
        ]
    ]
];
```

>Note: message format will be changed!
