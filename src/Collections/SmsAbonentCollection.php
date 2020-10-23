<?php

namespace borzakap\inteltelecom\Collections;

use borzakap\inteltelecom\Models\SmsAbonentModel;
use borzakap\inteltelecom\Models\BaseApiModel;
use borzakap\inteltelecom\Collections\BaseApiCollection;

/**
 * Class SmsAbonentCollection
 * 
 * @author borzakap <borzakap@gmail.com>
 */
class SmsAbonentCollection extends BaseApiCollection{
    
    public const ITEM_CLASS = SmsAbonentModel::class;

    /**
     * add to collection only valid phone numbers
     * @param BaseApiModel $value
     * @return BaseApiCollection
     */
    public function add(BaseApiModel $value): BaseApiCollection {
        if(!$value->getPhone()){
            return $this;
        }
        return parent::add($value);
    }
}
