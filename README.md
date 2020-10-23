# Inteltelecom API

## Instalation

```
composer require borzakap/inteltelecom 
```

## Start working

```php
$apiClient = new \borzakap\inteltelecom\ApiClient($severIp, $userLogin, $userPassword);
```

## Methods

### Send sms

```php
use borzakap\inteltelecom\Models\SmsMessageModel;
use borzakap\inteltelecom\Models\SmsAbonentModel;
use borzakap\inteltelecom\Collections\SmsMessageCollection;
use borzakap\inteltelecom\Collections\SmsAbonentCollection;

// create message
$message_model = new SmsMessageModel();
$message_model->setSender('sender');
$message_model->setText('text');

// create abonents collection
$abonent_model = new SmsAbonentModel();
$abonent_model->setPhone('0938499546')
    ->setTimeSend('2020-11-23 12:00') // optional - time to send sms (else it will be now)
    ->setValidityPeriod('2020-11-24 12:00') // optional - validity period (else it will be after 24 hour)
    ->setClientIdSms(3434); // optional - int flag do not send sms to same number with the same text
$abonent_collection->add($abonent_model);

// set abonents to message model
$message_model->setAbonent($abonent_collection);

// create message collection
$message_collection = new SmsMessageCollection();
$message_collection->add($message_model);

// send message
$result = $apiClient->sendSms($message_collection);
```
As result will be returned a SimpleXMLElement object
```php
$result[0]->information // with status 'send' in sucsses or error message
$result[0]->information['number_sms'] // number of sms
$result[0]->information['id_sms'] // internal id of sms (neaded to revise the status of sms)
$result[0]->information['parts'] // parts of sms` text (one part of sms equal 70 chars)
```
### Get sms states
```php
use borzakap\inteltelecom\Models\StateModel;
use borzakap\inteltelecom\Collections\StateCollection;

// create state model
$state_model = new StateModel();
$state_model->setIdSms($sms_id);

// create state collecton
$state_collection = new StateCollection();
$state_collection->add($state_model);

// send state request
$result = $apiClient->sendState($state_collection);
```
As result will be returned a SimpleXMLElement object 
```php
$result->information // with stateuses send | not_deliver | expired | deliver | partly_deliver
$result->information['id_sms'] // internal id of sms
$result->information['time'] // time of status was changed
```