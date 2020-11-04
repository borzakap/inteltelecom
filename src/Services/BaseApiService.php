<?php

namespace borzakap\inteltelecom\Services;

use borzakap\inteltelecom\ApiRequest;
use borzakap\inteltelecom\Collections\BaseApiCollection;
use SimpleXMLElement;

/**
 * Class BaseApiService
 *
 * @author borzakap
 */
abstract class BaseApiService {
    
    /**
     * xml object
     * @var SimpleXMLElement 
     */
    protected $xml;

    /**
     * method to send
     * @var string
     */
    protected $method;
    
    /**
     * server ip
     * @var string
     */
    protected $ip;

    /**
     * constructor
     * @param SimpleXMLElement $xml
     * @param string $ip
     */
    public function __construct(SimpleXMLElement $xml, string $ip) {
        $this->xml = $xml;
        $this->ip = $ip;
    }
    
    /**
     * get the method
     * @return string
     */
    public function getMethod(): string{
        return $this->method;
    }
    
    /**
     * get the ip
     * @return string
     */
    public function getIp(): string{
        return $this->ip;
    }

    /**
     * formating the xml
     * @abstract
     */
    abstract function format(BaseApiCollection $collection): void;
    
    /**
     * format xml object to string
     * @return string
     */
    public function asXml(): string{
        return $this->xml->asXML();
    }

    /**
     * sendign xml to server
     * @return SimpleXMLElement
     */
    public function send(): SimpleXMLElement{
        return ApiRequest::sendRequest($this->getIp(), $this->asXml(), $this->getMethod());
    }
   
}
