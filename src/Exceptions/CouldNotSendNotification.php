<?php

namespace Infinitypaul\Termii\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function serviceRespondedWithAnError($response): CouldNotSendNotification
    {
        return new static($response);
    }
}
