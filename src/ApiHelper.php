<?php

namespace borzakap\inteltelecom;

/**
 * Class apiHelper
 *
 * @author alexey
 */
class ApiHelper {

    const phoneCodes = [
        '38039', // Киевстар (Golden Telecom)
        '38050', // МТС
        '38063', // life:)
        '38066', // МТС
        '38067', // Киевстар
        '38068', // Киевстар (Beeline)
        '38073', // life:)
        '38091', // Utel
        '38092', // PEOPLEnet
        '38093', // life:)
        '38094', // Интертелеком
        '38095', // МТС
        '38096', // Киевстар
        '38097', // Киевстар
        '38098', // Киевстар
        '38099', // МТС
    ];

    /**
     * return the date to send
     * @param array $data
     * @return string
     */
    public static function setTimeSend(array $data): string {

        $now = time();

        if (isset($data['time_send']) && !empty($data['time_send'])) {
            $time_cur = strtotime($data['time_send']);
            $time_send = ($now > $time_cur) ? $now : $time_cur;
            return date('Y-m-d H:i', $time_send);
        }
        return date('Y-m-d H:i', $now);
    }

    /**
     * set the validity period
     * @param array $data
     * @return string
     */
    public static function setValidityPeriod(array $data): string {
        $now = time();

        if (isset($data['validity_period']) && !empty($data['validity_period'])) {
            $time_cur = strtotime($data['validity_period']);
            $time_send = ($now > $time_cur) ? ($now + 24 * 60 * 60) : $time_cur;
            return date('Y-m-d H:i', $time_send);
        }
        return date('Y-m-d H:i', ($now + 24 * 60 * 60));
    }

    /**
     * validate the phone number
     * @param array $data
     * @return string|null
     */
    public static function phoneValidate(array $data): ?string {
        if(!isset($data['phone']) || empty($data['phone'])){
            return null;
        }
        $p = preg_replace('/(\t|\n|\v|\f|\r| |\xC2\x85|\xc2\xa0|\xe1\xa0\x8e|\xe2\x80[\x80-\x8D]|\xe2\x80\xa8|\xe2\x80\xa9|\xe2\x80\xaF|\xe2\x81\x9f|\xe2\x81\xa0|\xe3\x80\x80|\xef\xbb\xbf)+/', '', $data['phone']);
        $p = preg_replace("/[^0-9]/", '', $p);
        $p = substr($p, -10);
        if (strlen($p) == 9) {
            $p = '380' . $p;
        }
        if (strlen($p) == 10) {
            $p = '38' . $p;
        }
        if (strlen($p) != 12) {
            return null;
        }
        if (self::isMobile($p)) {
            return $p;
        }
        return null;
    }

    /**
     * detect if phone number is mobile
     * @param string $phone
     * @return bool
     */
    private function isMobile(string $phone): bool {
        foreach (self::phoneCodes as $code) {
            $isMobile = strpos($phone, $code);
            if ($isMobile !== false) {
                return true;
            }
        }
        return false;
    }

}
