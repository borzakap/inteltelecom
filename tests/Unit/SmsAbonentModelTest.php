<?php

use PHPUnit\Framework\TestCase;
use borzakap\inteltelecom\Models\SmsAbonentModel;

/**
 * Test Class SmsAbonentModelTest
 *
 * @author borzakap
 */
class SmsAbonentModelTest extends TestCase{
    
    public $abonent_model;
    
    public function setUp(): void {
        $this->abonent_model = new SmsAbonentModel();
    }

    /**
     * @test
     */
    public function is_sms_abonent_phone_int(){
        $this->abonent_model->setPhone('(093) 849-95-46');
        $phone = $this->abonent_model->getPhone();
        $this->assertIsInt($phone);
    }
    
    /**
     * @test
     */
    public function is_sms_abonent_phone_right_format(){
        $this->abonent_model->setPhone('(093)849-95-46');
        $phone = $this->abonent_model->getPhone();
        $this->assertEquals('380938499546', $phone);
    }
    
    /**
     * @test
     */
    public function is_sms_abonent_time_send_datetime(){
        $this->abonent_model->setTimeSend('2025-10-21 23:21:11');
        $time_send = $this->abonent_model->getTimeSend();
        $this->assertIsString($time_send);
    }

    /**
     * @test
     */
    public function is_sms_abonent_time_send_right_format(){
        $this->abonent_model->setTimeSend('2025-10-21 23:21:11');
        $time_send = $this->abonent_model->getTimeSend();
        $this->assertEquals('2025-10-21 23:21', $time_send);
    }
    
    /**
     * @test
     */
    public function is_sms_abonent_time_send_with_null(){
        $this->abonent_model->setTimeSend();
        $time_send = $this->abonent_model->getTimeSend();
        $this->assertIsString($time_send);
    }

    /**
     * @test
     */
    public function is_sms_abonent_time_send_with_null_right_format(){
        $this->abonent_model->setTimeSend();
        $time_send = $this->abonent_model->getTimeSend();
        $this->assertEquals(date('Y-m-d H:i'), $time_send);
    }
    
    /**
     * @test
     */
    public function is_sms_abonent_time_send_wrong_date(){
        $this->abonent_model->setTimeSend('2020-10-20 23:21:11');
        $time_send = $this->abonent_model->getTimeSend();
        $date = new DateTime('now');
        $this->assertEquals($date->format('Y-m-d H:i'), $time_send);
    }


    /**
     * @test
     */
    public function is_sms_abonent_validity_period_datetime(){
        $this->abonent_model->setValidityPeriod('2025-10-21 23:21:11');
        $validty_period = $this->abonent_model->getValidityPeriod();
        $this->assertIsString($validty_period);
    }

    /**
     * @test
     */
    public function is_sms_abonent_validity_period_right_format(){
        $this->abonent_model->setValidityPeriod('2025-10-21 23:21:11');
        $validty_period = $this->abonent_model->getValidityPeriod();
        $this->assertEquals('2025-10-21 23:21', $validty_period);
    }
    
    /**
     * @test
     */
    public function is_sms_abonent_validity_period_with_null(){
        $this->abonent_model->setValidityPeriod();
        $validty_period = $this->abonent_model->getValidityPeriod();
        $this->assertIsString($validty_period);
    }

    /**
     * @test
     */
    public function is_sms_abonent_validity_period_with_null_right_format(){
        $this->abonent_model->setValidityPeriod();
        $validty_period = $this->abonent_model->getValidityPeriod();
        $date = new Datetime('+1 day');
        $this->assertEquals($date->format('Y-m-d H:i'), $validty_period);
    }
    
    /**
     * @test
     */
    public function is_sms_abonent_validity_period_wrong_date(){
        $this->abonent_model->setValidityPeriod('2020-10-20 23:21:11');
        $validty_period = $this->abonent_model->getValidityPeriod();
        $date = new Datetime('+1 day');
        $this->assertEquals($date->format('Y-m-d H:i'), $validty_period);
    }
    
    /**
     * @test
     */
    public function is_sms_abonent_client_id_sms_null(){
        $id_sms = $this->abonent_model->getClientIdSms();
        $this->assertNull($id_sms);
    }
    
    /**
     * @test
     */
    public function is_sms_abonent_client_id_sms_right(){
        $this->abonent_model->setClientIdSms(45);
        $id_sms = $this->abonent_model->getClientIdSms();
        $this->assertEquals(45, $id_sms);
    }
    
    /**
     * @test
     */
    public function is_sms_abonent_number_sms_int(){
        $this->abonent_model->setNumberSms(2);
        $number_sms = $this->abonent_model->getNumberSms();
        $this->assertIsInt($number_sms);
    }
    
    /**
     * @test
     */
    public function is_sms_abonent_number_sms_right() {
        $this->abonent_model->setNumberSms(2);
        $number_sms = $this->abonent_model->getNumberSms();
        $this->assertEquals(2, $number_sms);
    }
    
    /**
     * @test
     */
    public function is_sms_abonent_to_api_array(){
        $this->abonent_model->setPhone('(093)849-95-46');
        $to_api = $this->abonent_model->toApi();
        $this->assertIsArray($to_api);
    }
    
    /**
     * @test
     */
    public function is_sms_abonent_to_api_without_phone_array(){
        $to_api = $this->abonent_model->toApi();
        $this->assertIsArray($to_api);
    }
    
    /**
     * @test
     */
    public function has_sms_abonent_to_api_array_key_number_sms(){
        $to_api = $this->abonent_model->toApi();
        $this->assertArrayHasKey('number_sms', $to_api);
    }
    
    /**
     * @test
     */
    public function has_sms_abonent_to_api_array_key_phone(){
        $to_api = $this->abonent_model->toApi();
        $this->assertArrayHasKey('phone', $to_api);
    }
    
    /**
     * @test
     */
    public function has_sms_abonent_to_api_array_key_time_send(){
        $to_api = $this->abonent_model->toApi();
        $this->assertArrayHasKey('time_send', $to_api);
    }
    
    /**
     * @test
     */
    public function has_sms_abonent_to_api_array_key_validity_period(){
        $to_api = $this->abonent_model->toApi();
        $this->assertArrayHasKey('validity_period', $to_api);
    }
    
    /**
     * @test
     */
    public function not_has_sms_abonent_to_api_array_key_client_id_sms(){
        $to_api = $this->abonent_model->toApi();
        $this->assertArrayNotHasKey('client_id_sms', $to_api);
    }
    
    /**
     * @test
     */
    public function has_sms_abonent_to_api_array_key_client_id_sms(){
        $this->abonent_model->setClientIdSms(30);
        $to_api = $this->abonent_model->toApi();
        $this->assertArrayHasKey('client_id_sms', $to_api);
    }
}
