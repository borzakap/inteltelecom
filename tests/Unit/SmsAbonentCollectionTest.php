<?php

use PHPUnit\Framework\TestCase;
use borzakap\inteltelecom\Models\SmsAbonentModel;
use borzakap\inteltelecom\Collections\SmsAbonentCollection;

/**
 * Description of SmsAbonentCollectionTest
 *
 * @author alexey
 */
class SmsAbonentCollectionTest extends TestCase{
    
    /**
     * @test
     */
    public function is_abonent_collections_add_object(){
        $abonent_model = new SmsAbonentModel();
        $abonent_model->setPhone('0938499546');
        $abonent_collection = new SmsAbonentCollection();
        $abonent_collection->add($abonent_model);
        $this->assertIsObject($abonent_collection);
    }

    /**
     * @test
     */
    public function is_abonent_collection_add_to_api_array(){
        $abonent_model = new SmsAbonentModel();
        $abonent_model->setPhone('0938499546');
        $abonent_collection = new SmsAbonentCollection();
        $abonent_collection->add($abonent_model);
        $to_api = $abonent_collection->toApi();
        $this->assertIsArray($to_api);
    }
    
    /**
     * @test
     */
    public function is_abonent_collection_add_to_api_array_right_count(){
        $phones = ['0938499546', '0938499541', '0938496541'];
        $abonent_collection = new SmsAbonentCollection();
        foreach ($phones as $phone){
            $abonent_model = new SmsAbonentModel();
            $abonent_model->setPhone($phone)->setTimeSend('2020-12-03 22:30');
            $abonent_collection->add($abonent_model);
        }
        $to_api = $abonent_collection->toApi();
        $this->assertCount(3, $to_api);
    }
    
    
    
}
