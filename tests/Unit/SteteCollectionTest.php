<?php

use PHPUnit\Framework\TestCase;
use borzakap\inteltelecom\Models\StateModel;
use borzakap\inteltelecom\Collections\StateCollection;

/**
 * Test Class SteteCollectionTest
 *
 * @author borzakap
 */
class SteteCollectionTest extends TestCase{
    
    /**
     * @test
     */
    public function is_state_collection_to_api_right(){
        $sms_ids = [345, 456, 232134, null];
        $state_collection = new StateCollection();
        foreach ($sms_ids as $sms_id){
            $state_model = new StateModel();
            $state_model->setIdSms($sms_id);
            $state_collection->add($state_model);
        }
        $this->assertCount(3, $state_collection->toApi());
    }
}
