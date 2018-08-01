<?php namespace Signal\Validator;

use Signal\Exceptions\SendTextMessageValidatorException;

class MultiValidator
{
    /**
     * Validate multi message;
     *
     * @param string $text
     * @param array $numbers
     * @param bool $noDebug
     * @throws \Signal\Exceptions\SendTextMessageValidatorException
     */
    public static function validate($text, &$numbers, $noDebug = false)
    {
        if (!$text ||  !is_string($text) ) {
            throw new SendTextMessageValidatorException('can not send text message for empty or none string $text');
        }

        if (!$numbers || !is_array($numbers)) {
            throw new SendTextMessageValidatorException('can not send text message for empty or none integer $number');
        }

        foreach ($numbers as $index => $number) {
            $number = (int)$number;
            if ($noDebug) {
                if (!$number || !is_int($number)) {
                    unset($numbers[$index]);
                }
            } elseif (!$number || !is_int($number)) {
                throw new SendTextMessageValidatorException('Signal: can not send text message for empty or none integer $number');
            }
        }
    }
}