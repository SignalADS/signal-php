<?php namespace Signal;

use Signal\Exceptions\SendTextMessageException;
use Signal\Validator\MultiValidator;
use Signal\Validator\SingleValidator;

class TextMessage extends TextMessageBase
{
    /**
     * Send single text message
     *
     * @param string $text
     * @param string $number
     * @return mixed
     * @throws \Signal\Exceptions\SendTextMessageValidatorException
     * @throws \Signal\Exceptions\SendTextMessageException
     */
    public function send($text, $number)
    {
        SingleValidator::validate($text, $number);

        try {

            return $this->sendSingle($text, $number);
        } catch (\SoapFault $fault) {
            throw new SendTextMessageException("Signal SOAP Fault: (fault code: {$fault->faultcode}, fault string: {$fault->faultstring})",
                E_USER_ERROR);
        }
    }

    /**
     * Send multi text messages
     *
     * @param string $text
     * @param array $numbers
     * @return mixed
     * @throws \Signal\Exceptions\SendTextMessageValidatorException
     * @throws \Signal\Exceptions\SendTextMessageException
     */
    private function sends($text, $numbers)
    {
        MultiValidator::validate($text, $numbers);

        try {
            return $this->sendMulti($text, $numbers);
        } catch (\SoapFault $fault) {
            throw new SendTextMessageException($fault->faultstring, $fault->faultcode);
        }
    }
}