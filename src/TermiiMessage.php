<?php

namespace Infinitypaul\Termii;

class TermiiMessage
{
    /**
     * The message content.
     *
     * @var string
     */
    public $content;


    /**
     * This is the route through which the message is sent. It is either dnd, whatsapp, or generic
     *
     * @var string
     */
    public $channel;

    public $type = 'plain';


    /**
     * it is only available for the High Volume WhatsApp.
     *
     * @var array
     */
    public $media;


    public $media_url;

    public $media_caption;

    /**
     * The phone number the message should be sent from.
     *
     * @var string
     */
    public $from;

    /**
     * The phone number the message should be sent to.
     * This can also be set in the routeNotificationForTermii method.
     *
     * @var string|null
     */
    public $to;

    /**
     * Create a new message instance.
     *
     * @param string $content
     * @return void
     */
    public function __construct($content = '')
    {
        $this->content = $content;
    }

    /**
     * Set the message content.
     *
     * @param string $content
     * @return $this
     */
    public function content($content): TermiiMessage
    {
        $this->content = $content;

        return $this;
    }


    public function type($type): TermiiMessage
    {
        $this->type = $type;

        return $this;
    }

    public function channel($channel): TermiiMessage
    {
        $this->channel = $channel;

        return $this;
    }


    public function media(array $media): TermiiMessage
    {
        $this->media = $media;

        return $this;
    }


    public function media_url($media_url): TermiiMessage
    {
        $this->media_url = $media_url;

        return $this;
    }

    public function media_caption($media_caption): TermiiMessage
    {
        $this->media_caption = $media_caption;

        return $this;
    }

    /**
     * Set the phone number the message should be sent from.
     *
     * @param string $from
     * @return $this
     */
    public function from($from): TermiiMessage
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Set the phone number the message should be sent to.
     *
     * @param string|null $to
     * @return TermiiMessage
     */
    public function to($to): TermiiMessage
    {
        if ($to !== null) {
            $this->to = $to;
        }

        return $this;
    }
}
