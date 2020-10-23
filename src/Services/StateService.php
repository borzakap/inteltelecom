<?php

namespace borzakap\inteltelecom\Services;

use borzakap\inteltelecom\Collections\BaseApiCollection;
use borzakap\inteltelecom\Services\BaseApiService;
use SimpleXMLElement;

/**
 * Class StateService
 * 
 * @author borzakap <borzakap@gmail.com>
 * @package borzakap\inteltelecom\Services
 */

class StateService extends BaseApiService{

    protected string $method = 'state.php';

    /**
     * prepare xml object
     * @param BaseApiCollection $collections
     * @return void
     */
    public function format(BaseApiCollection $collections): void {
        $get_state = $this->xml->addChild('get_state');
        foreach ($collections->toApi() as $states){
            $this->formatState($get_state, $states);
        }
    }
    
    /**
     * format one element
     * @param SimpleXMLElement $get_state
     * @param array $states
     * @return void
     */
    protected function formatState(SimpleXMLElement $get_state, array $states): void{
        foreach ($states as $k => $v){
            $get_state->addChild($k, $v);
        }
    }
}