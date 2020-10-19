<?php

use PHPUnit\Framework\TestCase;
use borzakap\inteltelecom\ApiClient;

class ApiCleintTest extends TestCase{

    public $apiClient;


    public function setUp(): void {
        $severIp = '136.243.60.141';
        $userLogin = 'MILLENIUM';
        $userPassword = 'DZ5rzLCK';
        
        $this->apiClient = new ApiClient($severIp, $userLogin, $userPassword);
    }

    /**
     * @test 
     */
    public function sms_sending(){
        
        $params = [
            'sender' => 'senderName',
            'text' => 'text of sms message',
            'abonents' => [
                0 => [
                    'phone' => '0954845640', // required
                    'time_send' => '2020-10-16 20:00', // optional
                    'validity_period' => '2020-10-17 20:00', // optional
                    'client_id_sms' => '2023' // optional
                ],
                1 => [
                    'phone' => '0944845640', // required
                    'time_send' => '2020-10-16 10:00', // optional
                    'validity_period' => '2020-10-17 10:00', // optional
                    'client_id_sms' => '2023' // optional
                ]
            ]
        ];
        
        $sms = $this->apiClient->sendSms($params);
        
        $this->assertIsObject($sms);
        
    }
    

}