<?php

use PHPUnit\Framework\TestCase;
use borzakap\inteltelecom\Models\StateModel;
use borzakap\inteltelecom\Collections\StateCollection;
use borzakap\inteltelecom\Services\StateService;

/**
 * Test Class StateServiceTest
 *
 * @author borzakap <borzakap@gmail.com>
 */
class StateServiceTest extends TestCase{
    
    /**
     * @test
     */
    public function is_state_service_format_right() {
        $ip = '1.1.1.1.1';
        $xmlString = '<?xml version="1.0" encoding="utf-8"?><request></request>'; 
        $xml = new SimpleXMLElement($xmlString);
        $sms_ids = [345, 456, 232134, null];
        $state_collection = new StateCollection();
        foreach ($sms_ids as $sms_id){
            $state_model = new StateModel();
            $state_model->setIdSms($sms_id);
            $state_collection->add($state_model);
        }
        $state_service = new StateService($xml, $ip);
        $state_service->format($state_collection);
        $this->assertStringContainsString('345', $state_service->asXml());
    }
}
