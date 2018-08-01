<?php namespace Signal\Validator;

use Signal\Exceptions\SendTextMessageValidatorException;

class SingleValidator
{
    /**
     * Validate single message;
     *
     * @param $text
     * @param $number
     * @throws \Signal\Exceptions\SendTextMessageValidatorException
     */
    public static function validate($text, $number)
    {
        $number = (int) $number;

        if (!$text ||  !is_string($text) ) {
            throw new SendTextMessageValidatorException('can not send text message for empty or none string $text');
        }

        if(!$number || !is_int($number)) {
            throw new SendTextMessageValidatorException('can not send text message for empty or none integer $number');
        }
    }
}