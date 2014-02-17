Laravel 4 Pushover.net package
======
[![Latest Stable Version](https://poser.pugx.org/dyaa/pushover/v/stable.png)](https://packagist.org/packages/dyaa/pushover) [![Total Downloads](https://poser.pugx.org/dyaa/pushover/downloads.png)](https://packagist.org/packages/dyaa/pushover) [![Latest Unstable Version](https://poser.pugx.org/dyaa/pushover/v/unstable.png)](https://packagist.org/packages/dyaa/pushover) [![License](https://poser.pugx.org/dyaa/pushover/license.png)](https://packagist.org/packages/dyaa/pushover)

A Laravel 4 package for push notification service from pushover.net.

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

Now open: `app/config/packages/Dyaa/Pushover/config.php` and fill it with your data

```
return array(

    'token' => 'App Token',
    'user_key' => 'User Key',

);
```

Now you can use the package like that:

```
Will Write it tomorrow :) 
```

## License

Copyright (c) 2014 [Dyaa Eldin Moustafa][1] Licensed under the [MIT license][2].


  [1]: http://www.dyaa.me/
  [2]: https://github.com/dyaa/Laravel-pushover/blob/master/LICENSE