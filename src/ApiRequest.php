<?php

namespace borzakap\inteltelecom;

use borzakap\inteltelecom\ApiException;
use SimpleXMLElement;

/**
 * Class ApiRequest
 *
 * @package borzakap\inteltelecom
 * @author borzakap <borzakap@gmail.com>
 */
class ApiRequest {

    /**
     * sending the request to server
     * @param string $serverIp
     * @param string $xml
     * @param string $method
     * @return SimpleXMLElement
     */
    public static function sendRequest(
            string $serverIp,
            string $xml,
            string $method
    ) {
        $href = 'http://' . $serverIp . '/xml/' . $method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: text/xml; charset=utf-8'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CRLF, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($ch, CURLOPT_URL, $href);
        $result = curl_exec($ch);
        $error = curl_error($ch);
        $errno = curl_errno($ch);
        curl_close($ch);
        if ($result === false && !empty($error)) {
            throw new ApiException($errno, $error);
        }
        return self::parseResponce($result);
    }

    /**
     * parse responce
     * @param string $result
     * @return SimpleXMLElement
     * @throws ApiException
     */
    private static function parseResponce(?string $result): SimpleXMLElement {
        $response = new SimpleXMLElement($result);
        if (isset($response->error)) {
            throw new ApiException(300, $response->error);
        }
        return $response;
    }

}
