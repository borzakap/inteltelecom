<?php

namespace borzakap\inteltelecom\Models;

use borzakap\inteltelecom\ApiHelper;
use function is_callable;

/**
 * Class BaseApiModel
 *
 * @author alexey
 */
abstract class BaseApiModel {
    
    /**
     * format array for sending
     */
    abstract public function toApi(?int $key = 0): array;

    /**
     * getter
     * @param string $name
     * @return \self|null
     */
    public function __get(string $name): ?self {
        $method_name = 'get'.ApiHelper::toCamelCase($name);
        if(method_exists($this, $method_name)){
            return $this->$method_name();
        }
        return null;
    }
    
    /**
     * setter
     * @param string $name
     * @param mixed $value
     */
    public function __set(string $name, $value) {
        $method_name = 'set'.ApiHelper::toCamelCase($name);
        if(method_exists($this, $method_name) && is_callable([$this, $method_name])){
            $this->$method_name($value);
        }
    }
    
}
