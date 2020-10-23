<?php

namespace borzakap\inteltelecom\Services;

use borzakap\inteltelecom\Collections\BaseApiCollection;
use SimpleXMLElement;

/**
 * Class SmsService
 *
 * @package borzakap\inteltelecom\Services
 * @author borzakap
 */
class SmsService extends BaseApiService{
    
    protected string $method = '';

    /**
     * prepare xml object to send sms
     * @param BaseApiCollection $collections
     * @return void
     */
    public function format(BaseApiCollection $collections): void
    {
        foreach ($collections->toApi() as $collection){
            $this->formatMessage($collection);
        }
    }

    /**
     * prepare xml object for message
     * @param array $messages
     * @return void
     */
    protected function formatMessage(array $messages): void{
        $message = $this->xml->addChild('message');
        $message->addAttribute('type', 'sms');
        foreach ($messages as $k => $v){
            if($k == 'abonent'){
                $this->formatAbonents($message, $v);
            }else{
                $message->addAttribute($k, $v);
            }
        }
    }
    
    /**
     * prepare xml object for abonents
     * @param SimpleXMLElement $message
     * @param array $abonents
     * @return void
     */
    protected function formatAbonents(SimpleXMLElement $message, array $abonents): void{
        foreach ($abonents as $one_abonent){
            $this->formatAbonent($message, $one_abonent);
        }
    }
    
    /**
     * prepare xml object fo abonent
     * @param SimpleXMLElement $message
     * @param array $one_abonent
     * @return void
     */
    protected function formatAbonent(SimpleXMLElement $message, array $one_abonent): void{
        $abonent = $message->addChild('abonent');
        foreach($one_abonent as $name => $value){
            $abonent->addAttribute($name, $value);
        }
    }

}
