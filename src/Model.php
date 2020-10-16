<?php

namespace borzakap\inteltelecom;

use borzakap\inteltelecom\ApiException;

/**
 * Class Model
 * 
 * @package borzakap\inteltelecom
 * @author borzakap
 */
class Model {

    /**
     * Model Name
     * @var string
     */
    private $modelName;
    
    public function __construct(string $modelName){
        $this->modelName = 'borzakap\\inteltelecom\\Models\\' . $modelName;
    }

    public function __call($name, $parameters) {
        
        if (!class_exists($this->modelName)) {
            throw new ApiException(500, 'Model not exists: ' . $this->modelName);
        }
        
        $model = new $this->modelName();
        
        if(!method_exists($model, $name)){
            throw new ApiException(500, 'Method not exitst: '. $name);
        }
        return call_user_func_array(array($model, $name), $parameters);
    }

}
