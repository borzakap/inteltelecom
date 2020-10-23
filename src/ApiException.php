<?php

namespace borzakap\inteltelecom;

use Exception;
use Throwable;

/**
 * Class ApiException
 * 
 * @package borzakap\inteltelecom
 * @author borzakap <borzakap@gmail.com>
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
            int $code = 0,
            string $message = null, 
            Throwable $previous = null)
    {
        if (isset($this->errors[$code]) && !$message) {
            $message = $this->errors[$code];
        }
                
        $this->setErrorMessage($message)->setErrorCode($code);

        parent::__construct($message, $code, $previous);
    }
    
    /**
     * set error message
     * @param string $message
     * @return \borzakap\inteltelecom\ApiException
     */
    protected function setErrorMessage(string $message): ApiException{
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
    protected function setErrorCode(int $code): ApiException{
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
