<?php

namespace borzakap\inteltelecom\Models;

use borzakap\inteltelecom\Models\BaseApiModel;

/**
 * Class StateModel
 *
 * @author borzakap
 * @package borzakap\inteltelecom\Models
 */
class StateModel extends BaseApiModel{
    
    /**
     * id sms
     * @var string|null
     */
    protected ?string $id_sms = null;

    /**
     * set id sms
     * @param string|null $id_sms
     * @return \self
     */
    public function setIdSms(?string $id_sms): self{
        $this->id_sms = $id_sms;
        return $this;
    }

    /**
     * get id sms
     * @return string|null
     */
    public function getIdSms(): ?string{
        return $this->id_sms;
    }

    /**
     * prepare data for api
     * @param int $key
     * @return array
     */
    public function toApi(?int $key = 0): array {
        $result = [
            'id_sms' => $this->getIdSms(),
        ];
        return $result;
    }

}
