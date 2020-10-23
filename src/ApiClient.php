<?php

namespace borzakap\inteltelecom;

use borzakap\inteltelecom\ApiException;
use borzakap\inteltelecom\Collections\BaseApiCollection;
use borzakap\inteltelecom\Services\SmsService;
use borzakap\inteltelecom\Services\StateService;
use SimpleXMLElement;

/**
 * Class ApiClient
 *
 * @package borzakap\inteltelecom
 * @author borzakap
 */
class ApiClient{

    /**
     * server ip
     * @var string
     */
    private $serverIp;
    
    /**
     * simpleXmlElement of data
     * @var SimpleXMLElement
     */
    private $xml;

    /**
     * Construct
     * @param string $severIp
     * @param string $userLogin
     * @param string $userPassword
     * @throws ApiException
     */
    public function __construct(
            string $severIp,
            string $userLogin,
            string $userPassword
    ) {
        if(empty($severIp)){
            throw new ApiException(500, 'serverIp is required');
        }
        if(empty($userLogin)){
            throw new ApiException(500, 'userLogin is required');
        }
        if(empty($userPassword)){
            throw new ApiException(500, 'userPassword is required');
        }
        $this->serverIp = $severIp;
        $this->setLogin($userLogin, $userPassword);
    }

    /**
     * set login metadata
     * @param string $userLogin
     * @param string $userPassword
     */
    private function setLogin(string $userLogin, string $userPassword)
    {
        $xmlString = '<?xml version="1.0" encoding="utf-8"?><request></request>'; 
        $this->xml = new SimpleXMLElement($xmlString);
        $security = $this->xml->addChild('security');
        $login = $security->addChild('login');
        $login->addAttribute('value', $userLogin);
        $password = $security->addChild('password');
        $password->addAttribute('value', $userPassword);
    }
    
    /**
     * send sms reques
     * @param BaseApiCollection $collection
     * @return SimpleXMLElement
     */
    public function sendSms(BaseApiCollection $collection): SimpleXMLElement {
        $sms_service = new SmsService($this->xml, $this->serverIp);
        $sms_service->format($collection);
        return $sms_service->send();
    }
    
    /**
     * send state request
     * @param BaseApiCollection $collection
     * @return SimpleXMLElement
     */
    public function sendState(BaseApiCollection $collection): SimpleXMLElement {
        $state_service = new StateService($this->xml, $this->ip);
        $state_service->format($collection);
        return $state_service->send();
    }
}
