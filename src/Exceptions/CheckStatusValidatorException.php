<?php namespace Signal\Exceptions;

class CheckStatusValidatorException extends \Exception
{
    public function __construct(
        $message = "",
        $code = 0,
        \Throwable $previous = null
    ) {
        $message = "Signal validation error: $message";

        parent::__construct($message, $code, $previous);
    }
}