<?php

namespace borzakap\inteltelecom;

use borzakap\inteltelecom\ApiRequest;
use borzakap\inteltelecom\Model;
use borzakap\inteltelecom\ApiException;
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
    public $xml;

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
     * sending the sms
     * @param array $params
     * @return SimpleXMLElement
     */
    public function sendSms(array $params): SimpleXMLElement {
        $model = new Model('Sms');
        $model->Validate($params);
        $xml = $model->Format($params, $this->xml);
        print_r($xml->asXML());
        $response = ApiRequest::sendRequest($this->serverIp, $xml->asXML(), 'sms');
        return $response;
    }
    

}
