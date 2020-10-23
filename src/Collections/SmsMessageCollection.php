<?php

namespace borzakap\inteltelecom\Collections;

use borzakap\inteltelecom\Collections\BaseApiCollection;
use borzakap\inteltelecom\Models\SmsMessageModel;
use borzakap\inteltelecom\Models\BaseApiModel;
use borzakap\inteltelecom\ApiException;

/**
 * Class SmsMessageCollection
 *
 * @author borzakap <borzakap@gmail.com>
 */
class SmsMessageCollection extends BaseApiCollection{

    /**
     * set SmsMessageModel class
     */
    public const ITEM_CLASS = SmsMessageModel::class;
    
    /**
     * add data to collection
     * @param BaseApiModel $value
     * @return BaseApiCollection
     * @throws ApiException
     */
    public function add(BaseApiModel $value): BaseApiCollection {
        
        if(empty($value->getSender())){
            throw new ApiException(404, 'Sender name is required');
        }
        
        if(empty($value->getText())){
            throw new ApiException(404, 'Message text is required');
        }
        
        if(empty($value->getAbonent())){
            throw new ApiException(404, 'Abonents collection is required');
        }
        
        return parent::add($value);
    }

}
