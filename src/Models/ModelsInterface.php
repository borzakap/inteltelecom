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
     * @param SimpleXMLElement $sml
     */
    public function Format(array $params, SimpleXMLElement $sml);
    
    /**
     * Validate data
     * @param array $params
     */
    public function Validate(array $params);
    
}
