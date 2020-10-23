<?php

namespace borzakap\inteltelecom;

use DateTime;

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
     * validate time to send
     * @param string|null $time_send
     * @return string
     */
    public static function timeSendValidate(?string $time_send): string {
        $now = new DateTime('now');
        if ($time_send) {
            $time_cur = new DateTime($time_send);
            $time_send = ($now > $time_cur) ? $now : $time_cur;
            return $time_send->format('Y-m-d H:i');
        }
        return $now->format('Y-m-d H:i');
    }

    /**
     * validate validity period
     * @param string|null $validity_period
     * @return string
     */
    public static function validityPeriodValidate(?string $validity_period): string {
        $now = new DateTime('now');
        $one_day = new DateTime('+1 day');
        if ($validity_period) {
            $time_cur = new DateTime($validity_period);
            $time_send = ($now > $time_cur) ? $one_day : $time_cur;
            return $time_send->format('Y-m-d H:i');
        }
        return $one_day->format('Y-m-d H:i');
    }

    /**
     * format and validate phone number
     * @param string|null $phone
     * @return int|null
     */
    public static function phoneValidate(?string $phone): ?int {
        if (!$phone) {
            return null;
        }
        $p = preg_replace('/(\t|\n|\v|\f|\r| |\xC2\x85|\xc2\xa0|\xe1\xa0\x8e|\xe2\x80[\x80-\x8D]|\xe2\x80\xa8|\xe2\x80\xa9|\xe2\x80\xaF|\xe2\x81\x9f|\xe2\x81\xa0|\xe3\x80\x80|\xef\xbb\xbf)+/', '', $phone);
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
            return (int) $p;
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

    /**
     * set string to camel case
     * @param string $string
     * @return string
     */
    public static function toCamelCase(string $string): string {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
    }

}
