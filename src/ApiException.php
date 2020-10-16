<?php

namespace borzakap\inteltelecom;


use Exception;
use Throwable;

/**
 * Class ApiException
 * 
 * @package borzakap\inteltelecom
 * @author alexey
 */
class ApiException extends Exception{
    
    protected $message;
    
    protected $code;

    protected $errors = [
        '102' => 'No such method',
        '103' => 'Not enough data',
        '104' => 'Wrong data',
        '105' => 'Something went wrong',
        '106' => 'Requests are too frequent',
        '120' => 'Your company is disabled',
        '150' => 'Can`t call to the ext',
    ];
    
    public function __construct(
            $code = 0,
            $message = null, 
            Throwable $previous = null)
    {
        if (isset($this->errors[$code])) {
            $message = $this->errors[$code];
        }
        parent::__construct($message, $code, $previous);
        
        $this->setErrorMessage($message)->setErrorCode($code);
    }
    
    /**
     * set error message
     * @param string $message
     * @return \borzakap\inteltelecom\ApiException
     */
    public function setErrorMessage(string $message): ApiException{
        $this->message = $message;
        return $this;
    }
    
    /**
     * get the error message
     * @return string
     */
    public function getErrorMessage(): string {
        return $this->message;
    }
    
    /**
     * set the error code
     * @param int $code
     * @return \borzakap\inteltelecom\ApiException
     */
    public function setErrorCode(int $code): ApiException{
        $this->code = $code;
        return $this;
    }
    
    /**
     * get the error code
     * @return int
     */
    public function getErrorCode(): int{
        return $this->code;
    }
}
