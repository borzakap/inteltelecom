<?php

namespace borzakap\inteltelecom\Models;

use borzakap\inteltelecom\ApiHelper;
use DateTime;

/**
 * Description of SmsPhones
 *
 * @author alexey
 */
class SmsAbonentModel extends BaseApiModel{
    
    /**
     * phone number
     * @var int
     */
    private ?int $phone = null;
    
    /**
     * time to send
     * @var string
     */
    private string $time_send;
    
    /**
     * validity period
     * @var string
     */
    private string $validity_period;
    
    /**
     * client id sms
     * @var int|null
     */
    private ?int $client_id_sms = null;

    /**
     * number sms
     * @var int
     */
    private int $number_sms;

    /**
     * constructor
     */
    public function __construct() {
        $time_send = new DateTime('now');
        $this->time_send = $time_send->format('Y-m-d H:i');
        $validity_period = new DateTime('+1 day');
        $this->validity_period = $validity_period->format('Y-m-d H:i');
    }

    /**
     * get phone 
     * @return int|null
     */
    public function getPhone(): ?int {
        return $this->phone;
    }

    /**
     * set phone
     * @param string|null $phone
     * @return \self
     */
    public function setPhone(?string $phone): self {
        $this->phone = ApiHelper::phoneValidate($phone);
        return $this;
    }

    /**
     * get time to send
     * @return string
     */
    public function getTimeSend(): string {
        return $this->time_send;
    }

    /**
     * set time to send
     * @param string|null $time_send
     * @return \self
     */
    public function setTimeSend(?string $time_send = null): self {
        $this->time_send = ApiHelper::timeSendValidate($time_send);
        return $this;
    }

    /**
     * get validity period
     * @return string
     */
    public function getValidityPeriod(): string {
        return $this->validity_period;
    }
    
    /**
     * set validtity period
     * @param DateTime|null $validity_period
     * @return \self
     */
    public function setValidityPeriod(?string $validity_period = null): self{
        $this->validity_period = ApiHelper::validityPeriodValidate($validity_period);
        return $this;
    }

    /**
     * get clietn id sms
     * @return int|null
     */
    public function getClientIdSms(): ?int{
        return $this->client_id_sms;
    }
    
    /**
     * set clint id sms
     * @param int|null $client_id_sms
     * @return \self
     */
    public function setClientIdSms(?int $client_id_sms): self{
        $this->client_id_sms = $client_id_sms;
        return $this;
    }
    
    /**
     * get number sms
     * @return int
     */
    public function getNumberSms(): int{
        return $this->number_sms;
    }

    /**
     * set number sms
     * @param int $number_sms
     * @return \self
     */
    public function setNumberSms(int $number_sms): self {
        $this->number_sms = $number_sms;
        return $this;
    }

    /**
     * format data to array for api
     * @param int $number_sms
     * @return array
     */
    public function toApi(?int $number_sms = 0): array {
        $number_sms++;
        $this->setNumberSms($number_sms);
        $data = [
            'number_sms' => $this->getNumberSms(),
            'phone' => $this->getPhone(),
            'time_send' => $this->getTimeSend(),
            'validity_period' => $this->getValidityPeriod(),
        ];
        if($this->getClientIdSms()){
            $data['client_id_sms'] = $this->getClientIdSms();
        }
        return $data;
    }

}
