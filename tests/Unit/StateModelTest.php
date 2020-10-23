<?php

use PHPUnit\Framework\TestCase;
use borzakap\inteltelecom\Models\StateModel;

/**
 * Test Class StateModelTest
 *
 * @author borzakap
 */

class StateModelTest extends TestCase{
    
    /**
     * @test
     */
    public function is_state_model_id_sms_right(){
        $state_model = new StateModel();
        $state_model->setIdSms(345);
        $id_sms = $state_model->getIdSms();
        $this->assertEquals(345, $id_sms);
    }
    
    /**
     * @test
     */
    public function is_state_model_to_api_array(){
        $state_model = new StateModel();
        $state_model->setIdSms(345);
        $id_sms = $state_model->toApi();
        $this->assertIsArray($id_sms);
    }
}
