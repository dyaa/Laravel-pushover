Laravel 4 Pushover.net Package
======
[![Latest Stable Version](https://poser.pugx.org/dyaa/pushover/v/stable.png)](https://packagist.org/packages/dyaa/pushover) [![Total Downloads](https://poser.pugx.org/dyaa/pushover/downloads.png)](https://packagist.org/packages/dyaa/pushover) [![Latest Unstable Version](https://poser.pugx.org/dyaa/pushover/v/unstable.png)](https://packagist.org/packages/dyaa/pushover) [![License](https://poser.pugx.org/dyaa/pushover/license.png)](https://packagist.org/packages/dyaa/pushover)

A Laravel 4 package for Android push notification service from https://pushover.net/.

___

#### Installation

To get the latest version of dyaa/pushover simply require it in your `composer.json` file.

```
"dyaa/pushover": "dev-master"
```

Or

```
composer require dyaa/pushover:dev-master
```

After that, you'll need to run `composer update` to download the latest Version and updating the autoloader.

Once dyaa/pushover is installed, you need to register the ServiceProvider. To do that open `app/config/app.php` and add the following to the `providers` key.

```
'Dyaa\Pushover\PushoverServiceProvider',
```

## How to use
First you need to publish the config file. To do that, type the following in the terminal:

```
php artisan config:publish dyaa/pushover
```

Now open: `app/config/packages/Dyaa/Pushover/config.php` and fill it with your Token and the User Key https://pushover.net/

```
return array(

    'token' => 'App Token',
    'user_key' => 'User Key',

);
```

Now you can use the package like that:

To Set a message (**Required**)
```
Pushover::push($title, $message);
```
To Set a Link (Optional)
```
Pushover::url($url, $title);
```
To Set a Callback (Optional)
```
Pushover::callback($callbackURL);
```
To Set a Sound (Optional) Supported Notification Sounds https://pushover.net/api#sounds
```
Pushover::sound($sound);
```
To Set a Device Name (Optional)
```
Pushover::device($device);
```
To Set a Timestamp (Optional) Default is *time()*
```
Pushover::timestamp($timestamp);
```
To Set Priority (Optional) For More Info about Priority https://pushover.net/api#priority
```
Pushover::priority($priority, $retry, $expire);
```
To turn the Debug mode (Optional)
```
Pushover::debug(true);
```
To Send the Message (**Required**)
```
Pushover::send();
```
All other information will be found in details here https://pushover.net/api

## License

Copyright (c) 2014 [Dyaa Eldin Moustafa][1] Licensed under the [MIT license][2].


  [1]: http://www.dyaa.me/
  [2]: https://github.com/dyaa/Laravel-pushover/blob/master/LICENSE

[![Stories in Ready](https://badge.waffle.io/dyaa/Laravel-pushover.png?label=ready)](https://waffle.io/dyaa/Laravel-pushover) [![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/dyaa/laravel-pushover/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

