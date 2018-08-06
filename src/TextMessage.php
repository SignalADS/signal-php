<?php namespace Signal;

use Signal\Exceptions\SendTextMessageException;
use Signal\Exceptions\SignalSoapException;
use Signal\Validator\IdsValidator;
use Signal\Validator\MultiValidator;
use Signal\Validator\SingleValidator;

class TextMessage extends TextMessageBase
{
    /**
     * Send single text message
     *
     * @param string $text
     * @param array $numbers
     * @return mixed
     * @throws \Signal\Exceptions\SendTextMessageValidatorException
     * @throws \Signal\Exceptions\SendTextMessageException
     */
    public function send($text, $numbers)
    {
        SingleValidator::validate($text, $numbers);

        try {

            return $this->sendSingle($text, $numbers);
        } catch (\SoapFault $fault) {
            throw new SendTextMessageException("Signal SOAP Fault: (fault code: {$fault->faultcode}, fault string: {$fault->faultstring})",
                E_USER_ERROR);
        }
    }

    /**
     * Send multi text messages
     *
     * @param array $texts
     * @param array $numbers
     * @return mixed
     * @throws \Signal\Exceptions\SendTextMessageValidatorException
     * @throws \Signal\Exceptions\SendTextMessageException
     */
    public function sendMulti($texts, $numbers)
    {
        MultiValidator::validate($texts, $numbers);

        try {
            return $this->sendMultiText($texts, $numbers);
        } catch (\SoapFault $fault) {
            throw new SendTextMessageException($fault->faultstring, $fault->faultcode);
        }
    }

    /**
     * Get status form one or more messages
     *
     * @param array $messageIds
     * @return mixed
     * @throws \Signal\Exceptions\CheckStatusValidatorException
     * @throws \Signal\Exceptions\SignalSoapException
     */
    public function status($messageIds)
    {
        IdsValidator::validate($messageIds);

        try {
            return $this->checkStatus($messageIds);
        } catch (\SoapFault $fault) {
            throw new SignalSoapException($fault->faultstring, $fault->faultcode);
        }
    }

    /**
     * Get user credit
     *
     * @return mixed
     * @throws \Signal\Exceptions\SignalSoapException
     */
    public function credit()
    {
        try {
            return $this->checkCredit();
        } catch (\SoapFault $fault) {
            throw new SignalSoapException($fault->faultstring, $fault->faultcode);
        }
    }
}