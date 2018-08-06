<?php namespace Signal\Validator;

use Signal\Exceptions\SendTextMessageValidatorException;

class MultiValidator
{
    /**
     * Validate multi message;
     *
     * @param array $texts
     * @param array $numbers
     * @throws \Signal\Exceptions\SendTextMessageValidatorException
     */
    public static function validate($texts, $numbers)
    {
        if (!$texts || !is_array($texts)) {
            throw new SendTextMessageValidatorException('can not send text message for empty or none array $texts');
        }

        if (!$numbers || !is_array($numbers)) {
            throw new SendTextMessageValidatorException('can not send text message for empty or none array $numbers');
        }

        foreach ($numbers as $index => $number) {

            SingleValidator::validate($texts[$index],
                is_array($number) ? $number : [$number]);

        }
    }
}