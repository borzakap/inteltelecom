<?php

use PHPUnit\Framework\TestCase;
use borzakap\inteltelecom\Models\SmsMessageModel;
use borzakap\inteltelecom\Models\SmsAbonentModel;
use borzakap\inteltelecom\Collections\SmsAbonentCollection;
use borzakap\inteltelecom\ApiException;

/**
 * Test Class SmsMessageModelTest
 *
 * @author borzakap
 */
class SmsMessageModelTest extends TestCase{
    
    public $message_model;

    public function setUp(): void {
        $this->message_model = new SmsMessageModel();
    }

    /**
     * @test
     */
    public function is_sms_message_sender_string(){
        $this->message_model->setSender('Sender');
        $sender = $this->message_model->getSender();
        $this->assertIsString($sender);
    }
    
    /**
     * @test
     */
    public function is_sms_message_sender_right() {
        $this->message_model->setSender('Sender');
        $sender = $this->message_model->getSender();
        $this->assertEquals('Sender', $sender);
    }
    
    /**
     * @test
     */
    public function is_sms_message_text_string() {
        $this->message_model->setText('Text of sms');
        $text = $this->message_model->getText();
        $this->assertIsString($text);
    }

    /**
     * @test
     */
    public function is_sms_message_text_right(){
        $this->message_model->setText('Text of sms');
        $text = $this->message_model->getText();
        $this->assertEquals('Text of sms', $text);
    }
    
    /**
     * @test
     */
    public function is_sms_message_abonent_object() {
        $abonent_model = new SmsAbonentModel();
        $abonent_model->setPhone('0938499546');
        $abonent_collection = new SmsAbonentCollection();
        $abonent_collection->add($abonent_model);
        $this->message_model->setAbonent($abonent_collection);
        $abonent = $this->message_model->getAbonent();
        $this->assertIsObject($abonent);
    }
    
    /**
     * @test
     */
    public function is_sms_message_to_api_array(){
        $abonent_model = new SmsAbonentModel();
        $abonent_model->setPhone('0938499546');
        $abonent_collection = new SmsAbonentCollection();
        $abonent_collection->add($abonent_model);
        $this->message_model->setSender('sender');
        $this->message_model->setText('text');
        $this->message_model->setAbonent($abonent_collection);
        $message = $this->message_model->toApi();
        $this->assertIsArray($message);
    }
    
    /**
     * @test
     */
    public function is_sms_message_to_api_abonent_array(){
        $abonent_model = new SmsAbonentModel();
        $abonent_model->setPhone('0938499546');
        $abonent_collection = new SmsAbonentCollection();
        $abonent_collection->add($abonent_model);
        $this->message_model->setSender('sender');
        $this->message_model->setText('text');
        $this->message_model->setAbonent($abonent_collection);
        $message = $this->message_model->toApi();
        $this->assertIsArray($message['abonent']);
    }
    
}
