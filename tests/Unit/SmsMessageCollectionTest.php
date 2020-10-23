<?php

use PHPUnit\Framework\TestCase;
use borzakap\inteltelecom\Models\SmsMessageModel;
use borzakap\inteltelecom\Models\SmsAbonentModel;
use borzakap\inteltelecom\Collections\SmsMessageCollection;
use borzakap\inteltelecom\Collections\SmsAbonentCollection;

/**
 * Test Class SmsMessageCollectionTest
 *
 * @author borzakap
 */
class SmsMessageCollectionTest extends TestCase{
    
    /**
     * @test
     */
    public function is_sms_message_collection_add_object(){
        $abonent_model = new SmsAbonentModel();
        $abonent_model->setPhone('0938499546');
        $abonent_collection = new SmsAbonentCollection();
        $abonent_collection->add($abonent_model);
        $message_model = new SmsMessageModel();
        $message_model->setSender('sender');
        $message_model->setText('text');
        $message_model->setAbonent($abonent_collection);
        $message_collection = new SmsMessageCollection();
        $messge_object = $message_collection->add($message_model);
        $this->assertIsObject($messge_object);
    }
    
    /**
     * @test
     */
    public function is_sms_message_collection_to_api_array(){
        $abonent_model = new SmsAbonentModel();
        $abonent_model->setPhone('0938499546');
        $abonent_collection = new SmsAbonentCollection();
        $abonent_collection->add($abonent_model);
        $message_model = new SmsMessageModel();
        $message_model->setSender('sender');
        $message_model->setText('text');
        $message_model->setAbonent($abonent_collection);
        $message_collection = new SmsMessageCollection();
        $messge_object = $message_collection->add($message_model);
        $this->assertIsArray($messge_object->toApi());
    }
    
    /**
     * @test
     */
    public function is_sms_message_collection_count_right(){
        $abonent_model = new SmsAbonentModel();
        $abonent_model->setPhone('0938499546');
        $abonent_collection = new SmsAbonentCollection();
        $abonent_collection->add($abonent_model);
        $message_collection = new SmsMessageCollection();
        for($i = 0; $i <= 10; $i++){
            $message_model = new SmsMessageModel();
            $message_model->setSender('sender' . $i);
            $message_model->setText('text' . $i);
            $message_model->setAbonent($abonent_collection);
            $message_collection->add($message_model);
        }
        $this->assertCount(11, $message_collection->toApi());
    }
}
