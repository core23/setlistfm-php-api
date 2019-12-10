Setlist.fm PHP library
======================
[![Latest Stable Version](https://poser.pugx.org/core23/setlistfm-api/v/stable)](https://packagist.org/packages/core23/setlistfm-api)
[![Latest Unstable Version](https://poser.pugx.org/core23/setlistfm-api/v/unstable)](https://packagist.org/packages/core23/setlistfm-api)
[![License](https://poser.pugx.org/core23/setlistfm-api/license)](LICENSE.md)

[![Total Downloads](https://poser.pugx.org/core23/setlistfm-api/downloads)](https://packagist.org/packages/core23/setlistfm-api)
[![Monthly Downloads](https://poser.pugx.org/core23/setlistfm-api/d/monthly)](https://packagist.org/packages/core23/setlistfm-api)
[![Daily Downloads](https://poser.pugx.org/core23/setlistfm-api/d/daily)](https://packagist.org/packages/core23/setlistfm-api)

[![Continuous Integration](https://github.com/core23/setlistfm-php-api/workflows/Continuous%20Integration/badge.svg)](https://github.com/core23/setlistfm-php-api/actions)
[![Code Coverage](https://codecov.io/gh/core23/setlistfm-php-api/branch/master/graph/badge.svg)](https://codecov.io/gh/core23/setlistfm-php-api)

This library provides a wrapper for using the [Setlist.fm API] inside PHP and a bridge for symfony.

## Installation

Open a command console, enter your project directory and execute the following command to download the latest stable version of this library:

```
composer require core23/setlistfm-api

composer require guzzlehttp/guzzle # if you want to use Guzzle native
composer require php-http/guzzle6-adapter # if you want to use HTTPlug with Guzzle
```

## Usage

### General usage
```php
// Get HTTPlug client and message factory
$client         = \Http\Discovery\HttpClientDiscovery::find();
$messageFactory = \Http\Discovery\MessageFactoryDiscovery::find();

// Create connection
$connection = new \Core23\SetlistFm\Connection\HTTPlugConnection($client, $messageFactory);

$artistApi = new \Core23\SetlistFm\Service\ArtistService($connection);
$artists = $artistApi->search(ArtistSearchBuilder::create()
    ->withArtistName('Slipknot')
);
```

## License

This library is under the [MIT license](LICENSE.md).

[HTTPlug]: http://docs.php-http.org/en/latest/index.html
[Setlist.fm API]: https://api.setlist.fm
