<?php

namespace borzakap\inteltelecom\Collections;

use borzakap\inteltelecom\Models\BaseApiModel;
use borzakap\inteltelecom\Models\StateModel;
use borzakap\inteltelecom\Collections\BaseApiCollection;

/**
 * Class StateCollection
 *
 * @author borzakap <borzakap@gmail.com>
 * @package borzakap\inteltelecom\Collections
 */
class StateCollection extends BaseApiCollection{
    
    /**
     * item of StateModel::class
     */
    public const ITEM_CLASS = StateModel::class;
    
    /**
     * add items to collection
     * @param BaseApiModel $value
     * @return BaseApiCollection
     */
    public function add(BaseApiModel $value): BaseApiCollection {
        if(empty($value->getIdSms())){
            return $this;
        }
        return parent::add($value);
    }
}
