<?php

namespace borzakap\inteltelecom\Collections;

use borzakap\inteltelecom\Models\BaseApiModel;
use borzakap\inteltelecom\ApiException;
use ArrayAccess;
use InvalidArgumentException;

/**
 * Description of BaseApiCollection
 *
 * @author alexey
 */
abstract class BaseApiCollection implements ArrayAccess{

    /**
     * Models class
     * @var string
     */
    const ITEM_CLASS = '';
    
    /**
     * collections data
     * @var arra
     */
    protected $data = [];
    
    /**
     * check the item instance
     * @param type $item
     * @return BaseApiModel
     * @throws InvalidArbumentException
     */
    protected function checkItem($item): BaseApiModel{
        $class = static::ITEM_CLASS;
        if(!is_object($item) || !($item instanceof $class)){
            throw new InvalidArgumentException('Items must be an instantce of class '. $class);
        }
        return $item;
    }
    
    /**
     * add data to collection
     * @param BaseApiModel $value
     * @return \self
     */
    public function add(BaseApiModel $value): self{
        $this->data[] = $this->checkItem($value);
        return $this;
    }

    /**
     * set data to array for api
     * @return array
     */
    public function toApi(): array {
        if(empty($this->data)){
            $class = static::ITEM_CLASS;
            throw new ApiException(401, 'Collection is empty for Model: ' . $class);
        }
        $result = [];
        foreach ($this->data as $key => $item){
            $result[$key] = $item->toApi($key);
        }
        return $result;
    }
    
    /**
     * @param string|int $offset
     * @return bool
     */
    public function offsetExists($offset): bool {
        return array_key_exists($offset, $this->data);
    }
    
    /**
     * @param string|int $offset
     * @return BaseApiModel|null
     */
    public function offsetGet($offset): ?BaseApiModel {
        return $this->data[$offset] ?? null;
    }
    
    /**
    * @param string|int $offset
    * @param BaseApiModel $value
    * @return $this
    */
    public function offsetSet($offset, $value): self {
        $this->data[$offset] = $this->checkItem($value);
        return $this;
    }
     
    /**
     * Delete element from collection
     * @param string|int $offset
     * @return $this
     */
    public function offsetUnset($offset): self {
        unset($this->data[$offset]);
        return $this;
    }
}
