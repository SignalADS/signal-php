<?php namespace Signal\Exceptions;

class SendTextMessageException extends \SoapFault
{

    public function __construct(
        $message = "",
        $code = 0,
        \Throwable $previous = null
    ) {
        $message = "Signal SOAP Fault: (fault code: {$code}, fault string: {$message})";

        parent::__construct($message, $code, $previous);
    }

}