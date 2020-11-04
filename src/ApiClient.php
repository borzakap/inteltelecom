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
    private $server_ip;
    
    /**
     * simpleXmlElement of data
     * @var SimpleXMLElement
     */
    private $xml;

    /**
     * Construct
     * @param string $server_ip
     * @param string $user_login
     * @param string $user_password
     * @throws ApiException
     */
    public function __construct(
            string $server_ip,
            string $user_login,
            string $user_password
    ) {
        if(empty($server_ip)){
            throw new ApiException(500, 'server IP is required');
        }
        if(empty($user_login)){
            throw new ApiException(500, 'user login is required');
        }
        if(empty($user_password)){
            throw new ApiException(500, 'user password is required');
        }
        $this->server_ip = $server_ip;
        $this->setLogin($user_login, $user_password);
    }

    /**
     * set login metadata
     * @param string $user_login
     * @param string $user_password
     */
    private function setLogin(string $user_login, string $user_password)
    {
        $xmlString = '<?xml version="1.0" encoding="utf-8"?><request></request>'; 
        $this->xml = new SimpleXMLElement($xmlString);
        $security = $this->xml->addChild('security');
        $login = $security->addChild('login');
        $login->addAttribute('value', $user_login);
        $password = $security->addChild('password');
        $password->addAttribute('value', $user_password);
    }
    
    /**
     * send sms request
     * @param BaseApiCollection $collection
     * @return SimpleXMLElement
     */
    public function sendSms(BaseApiCollection $collection): SimpleXMLElement {
        $sms_service = new SmsService($this->xml, $this->server_ip);
        $sms_service->format($collection);
        return $sms_service->send();
    }
    
    /**
     * send state request
     * @param BaseApiCollection $collection
     * @return SimpleXMLElement
     */
    public function sendState(BaseApiCollection $collection): SimpleXMLElement {
        $state_service = new StateService($this->xml, $this->server_ip);
        $state_service->format($collection);
        return $state_service->send();
    }
}
