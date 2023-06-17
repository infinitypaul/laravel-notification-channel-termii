# Termii notifications channel for Laravel


This package brings you the joy of sending [Termii notifications](https://developer.termii.com) with Laravel, with the same effortlessness as a Sunday morning coffee. Take a sip and let's get started.

## Contents

- [Installation](#installation)
    - [Setting up your Termii account](#setting-up-your-termii-account)
- [Usage](#usage)
    - [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Installation

You can install the package faster than you can say "composer" via composer:

``` bash
composer require infinitypaul/laravel-notification-channel-termii
```
Service providers... You gotta love them. You either have to install them yourself, or if you're living on the edge with Laravel 5.5 or higher, let the package auto discovery do the work for you:

```php
// config/app.php
'providers' => [
    ...
    Infinitypaul\Termii\TermiiServiceProvider::class,
],

```
### Setting up your Termii account

Time to tell Laravel your deepest secret (aka your Termii API Key). Also, add your favorite channel and an optional Sender ID. Whisper these to your config/services.php:


```php
// config/services.php
'termii' => [
'key' => env('TERMII_API_KEY'),
'from' => env('TERMII_FROM'),
'channel' => 'dnd' //because I know you love 'do not disturb' mode 😉
]
```

## Usage

The next step is as easy as pie. Simply use the channel in your via() method inside the notification:

```php
use Infinitypaul\Termii\TermiiChannel;
use Infinitypaul\Termii\TermiiMessage;
use Illuminate\Notifications\Notification;

class WelcomeSMS extends Notification
{
public function via($notifiable)
{
return [TermiiChannel::class]; // see? pie!
}

    public function toTermii($notifiable)
    {
        return (new TermiiMessage())
            ->content("Thanks For Subscribing to infinitypaul.medium.com. We promise to only send interesting stuff, no cat videos... well, maybe just one.");
    }
}
```

Let's tell your Notification where it's heading(which phone are you sending to). Add the routeNotificationForTermii method to your Notifiable model (e.g., your User Model).


```php
public function routeNotificationForTermii()
{
    return $this->phone; // where `phone` is a field in your users table;
}

```

### Available Message methods

#### TermiiMessage

- `from('')`: Accepts a string -Represents a sender ID for sms which can be Alphanumeric or Device name for Whatsapp. Alphanumeric sender ID length should be between 3 and 11 characters (Example:CompanyName).
- `content('')`: Accepts a string - Text of a message that would be sent to the destination phone number.
- `channel('')`: Accepts a string This is the route through which the message is sent. It is either `dnd`, `whatsapp`, or `generic`, by default it is dnd.
- `media('')`: Accepts an array, if your channel is `whatsapp` This is a media object, it is only available for the High Volume WhatsApp. When using the media parameter, ensure you are not using the sms parameter.
- `media_url('')`: Accepts a string, if your channel is `whatsapp` The url to the file resource,.
- `media_option('')`: Accepts a string, if your channel is `whatsapp` The caption that should be added to the image,.


## Changelog
Curious about our termii journey? Check out CHANGELOG for more information on what has changed recently.

## Testing
```php
composer test //(We promise it won't explode.)
```

## Security
Discovered any security issues? Please email us at infinitypaul@live.com. We promise to take it seriously, instead of using the issue tracker..

## Credits

- [Paul Edward](https://github.com/infinitypaul)


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
