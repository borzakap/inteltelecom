<?php

use PHPUnit\Framework\TestCase;
use borzakap\inteltelecom\Models\SmsMessageModel;
use borzakap\inteltelecom\Models\SmsAbonentModel;
use borzakap\inteltelecom\Collections\SmsMessageCollection;
use borzakap\inteltelecom\Collections\SmsAbonentCollection;
use borzakap\inteltelecom\Services\SmsService;

/**
 * Test Class SmsServiceTest
 *
 * @author alexey
 */
class SmsServiceTest extends TestCase{
    
    /**
     * @test
     */
    public function is_sms_service_contain_rigt_data() {
        $ip = '1.1.1.1.1';
        $xmlString = '<?xml version="1.0" encoding="utf-8"?><request></request>'; 
        $xml = new SimpleXMLElement($xmlString);
        $abonent_collection = new SmsAbonentCollection();
        for ($i = 0; $i <= 4; $i++){
            $abonent_model = new SmsAbonentModel();
            $abonent_model->setPhone('0938499546');
            $abonent_collection->add($abonent_model);
        }
        $message_model = new SmsMessageModel();
        $message_model->setSender('sender');
        $message_model->setText('text');
        $message_model->setAbonent($abonent_collection);
        $message_collection = new SmsMessageCollection();
        $message_collection->add($message_model);
        $message_service = new SmsService($xml, $ip);
        $message_service->format($message_collection);
        var_dump($message_service->asXML());
        $this->assertStringContainsString('0938499546', $message_service->asXML());
    }
}
