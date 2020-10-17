<?php

namespace borzakap\inteltelecom\Models;

use borzakap\inteltelecom\ApiHelper;
use borzakap\inteltelecom\ApiException;
use SimpleXMLElement;

/**
 * Model to sending Sms
 *
 * @package borzakap\inteltelecom\Models
 * @author alexey
 */
class Sms implements ModelsInterface{
    

    /**
     * Formating the sms xml
     * @param array $params
     * @param SimpleXMLElement $xml
     * @return SimpleXMLElement
     */
    public function Format(array $params, SimpleXMLElement $xml)
    {
        $numSms = 0;
        $message = $xml->addChild('message');
        $message->addAttribute('type', 'sms');
        $message->addChild('sender', $params['sender']);
        $message->addChild('text', $params['text']);
        foreach ($params['abonents'] as $abonentdata){
            if(!$phone = ApiHelper::phoneValidate($abonentdata)){
                continue;
            }
            $numSms++;
            $abonent = $message->addChild('abonent');
            $abonent->addAttribute('phone', $phone);
            $abonent->addAttribute('number_sms', $numSms);
            $abonent->addAttribute('time_send', ApiHelper::setTimeSend($abonentdata));
            $abonent->addAttribute('validity_period', ApiHelper::setValidityPeriod($abonentdata));
            if(isset($abonentdata['client_id_sms']) && !empty($abonentdata['client_id_sms'])){
                $abonent->addAttribute('client_id_sms', (int)$abonentdata['client_id_sms']);
            }
        }
        if($numSms === 0){ 
            throw new ApiException(404, 'There is no valid phone numbers');
        }
        return $xml;
    }
    
    /**
     * validating the sms parameters
     * @param array $params
     * @throws ApiException
     */
    public function Validate(array $params){
        
        if(!isset($params['sender']) || empty($params['sender'])){
            throw new ApiException(404, 'There is no sender name');
        }
        
        if(!isset($params['text']) || empty($params['text'])){
            throw new ApiException(404, 'There is no text');
        }
        
        if(!isset($params['abonents']) || !count($params['abonents'])){
            throw new ApiException(404, 'There is no abonents');
        }
    }

}
