# Intletelecom API

## Instalation

```
composer require borzakap/inteltelecom 
```

## Start working

```php
$apiClient = new \borzakap\inteltelecom\ApiClient($severIp, $userLogin, $userPassword);
```

## Methods

### Sending sms

```php
$data[
    'sender' => 'senderName', // required
    'text' => 'text of sms message', // required
    'abonents' => [
        0 => [
            'phone' => '0954845640', // required
            'time_send' => '2020-10-16 20:00', // optional
            'validity_period' => '2020-10-17 20:00', // optional
            'client_id_sms' => '2023' // optional
        ]
        .........
        100 => [
            'phone' => '0944845640', // required
            'time_send' => '2020-10-16 10:00', // optional
            'validity_period' => '2020-10-17 10:00', // optional
            'client_id_sms' => '2023' // optional
        ]
    ]
];

$result = $apiClient->sendSms($data);
```
As result will be returned an SimpleXMLElement object
```php
$result[0]->information // with status 'send' in sucsses or error message
$result[0]->information['number_sms'] // number of sms
$result[0]->information['id_sms'] // internal id of sms (neaded to revise the status of sms)
$result[0]->information['parts'] // parts of sms` text (one part of sms equal 70 chars)
```