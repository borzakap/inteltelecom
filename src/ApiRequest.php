<?php

namespace borzakap\inteltelecom;

use borzakap\inteltelecom\ApiException;
use SimpleXMLElement;

/**
 * Class ApiRequest
 *
 * @package borzakap\inteltelecom
 * @author alexey
 */
class ApiRequest {

    /**
     * sending the request to server
     * @param string $serverIp
     * @param string $body
     * @param string $method
     * @return string
     */
    public static function sendRequest(
            string $serverIp,
            string $body,
            string $method
    ) {

        $methodSlug = ($method != 'sms') ? $method . '.php' : '';

        $href = 'http://' . $serverIp . '/xml/' . $methodSlug;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: text/xml; charset=utf-8'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CRLF, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_URL, $href);
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        $error = curl_error($ch);
        $errno = curl_errno($ch);

        curl_close($ch);

        if ($result === false && !empty($error)) {
            throw new ApiException($errno, $error);
        }

        return $this->parseResponce($result, $info);
    }

    /**
     * parse responce
     * @param string $result
     * @param array $info
     * @return SimpleXMLElement
     * @throws ApiException
     */
    private function parseResponce(string $result, array $info): SimpleXMLElement {
        $response = new SimpleXMLElement($result);
        if (isset($response->response->error)) {
            throw new ApiException($info['http_code'], $response->response->error);
        }
        return $response->response;
    }

}
