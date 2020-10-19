<?php

namespace borzakap\inteltelecom\Models;

use SimpleXMLElement;

/**
 * Description of ModelsInterface
 *
 * @author alexey
 */
interface ModelsInterface {

    /**
     * Formating the xml
     * @param array $params
     * @param SimpleXMLElement $xml
     */
    public function Format(array $params, SimpleXMLElement $xml);
    
    /**
     * Validate data
     * @param array $params
     */
    public function Validate(array $params);
    
}
