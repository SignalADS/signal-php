<?php namespace Signal\Validator;

use Signal\Exceptions\SendTextMessageValidatorException;

class SingleValidator
{
    /**
     * Validate single message;
     *
     * @param string $text
     * @param array $numbers
     * @throws \Signal\Exceptions\SendTextMessageValidatorException
     */
    public static function validate($text, $numbers)
    {
        if (!$text ||  !is_string($text) ) {
            throw new SendTextMessageValidatorException('can not send text message for empty or none string $text');
        }

        if(!$numbers || !is_array($numbers)) {
            throw new SendTextMessageValidatorException('can not send text message for empty or none array $numbers');
        } else {
            foreach ($numbers as $number) {
                if(!$number) {
                    throw new SendTextMessageValidatorException('can not send text message for empty or valid $number');
                }
            }
        }
    }
}