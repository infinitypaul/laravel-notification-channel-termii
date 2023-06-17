<?php

namespace Infinitypaul\Termii\Exceptions;

class NotSet extends \Exception
{
    public static function serviceRespondedWithAnError($response): NotSet
    {
        return new static($response);
    }
}
