<?php

namespace Infinitypaul\Termii;

use Infinitypaul\Termii\Exceptions\CouldNotSendNotification;
use Illuminate\Notifications\Notification;

class TermiiChannel
{

    protected $termii;

    public function __construct(Termii $termii)
    {
        $this->termii = $termii;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     *
     * @return void
     * @throws CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('termii')) {
            throw CouldNotSendNotification::serviceRespondedWithAnError('Missing destination number');
        }

        $message = $notification->toTermii($notifiable);

        if (is_string($message)) {
            $message = new TermiiMessage($message);
        }

        if (! $channel = $message->channel ?: config('services.termii.channel')) {
            throw CouldNotSendNotification::serviceRespondedWithAnError('Missing channel ');
        }

        if (! $from = $message->from ?: config('services.termii.from')) {
            throw CouldNotSendNotification::serviceRespondedWithAnError('Missing sender ID ');
        }

        try {
            $payload =  $this->termii->add('to', $to)
                ->add('sms', $message->content)
                ->add('from', $from)
                ->add('type', $message->type)
                ->add('channel', $channel);

            if($channel == 'whatsapp'){
                $payload->add('media', $message->media)
                    ->add('media_url', $message->media_url)
                    ->add('media_caption', $message->media_caption);
            }

           return $payload->sendMessage();

        } catch (\Exception $exception) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($exception);
        }

    }
}
