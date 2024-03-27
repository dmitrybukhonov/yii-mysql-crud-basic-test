<?php

namespace app\modules\subscribe\helpers;

final class SmsPilotMessage
{
    /**
     * @param string $phone
     * @param string $text
     * @return void
     */
    public static function send(string $phone, string $text): void
    {
        file_get_contents('https://smspilot.ru/api.php?send=' . $text . '&to=' . $phone . '&apikey=' . getenv('SMS_PILOT_TOKEN') . '&format=v');
    }
}
