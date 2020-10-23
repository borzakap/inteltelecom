<?php

namespace borzakap\inteltelecom\Models;

use borzakap\inteltelecom\Collections\SmsAbonentCollection;

/**
 * Description of SmsMessageModel
 *
 * @author borzakap <borzakap@gmail.com>
 */

class SmsMessageModel extends BaseApiModel{
    
    /**
     * sender name
     * @var string|null
     */
    private ?string $sender = null;
    
    /**
     * message text
     * @var string|null
     */
    private ?string $text = null;
    
    /**
     * abonents collection
     * @var SmsAbonentCollection|null
     */
    private ?SmsAbonentCollection $abonent = null;

    /**
     * get sender
     * @return string|null
     */
    public function getSender(): ?string{
        return $this->sender;
    }

    /**
     * set sender
     * @param string $sender
     * @return \self
     */
    public function setSender(string $sender): self{
        $this->sender = $sender;
        return $this;
    }

    /**
     * get text
     * @return string|null
     */
    public function getText(): ?string{
        return $this->text;
    }

    /**
     * set text
     * @param string $text
     * @return \self
     */
    public function setText(string $text): self{
        $this->text = $text;
        return $this;
    }
    
    /**
     * get abonents
     * @return SmsAbonentCollection|null
     */
    public function getAbonent(): ?SmsAbonentCollection {
        return $this->abonent;
    }
    
    /**
     * set abonents
     * @param SmsAbonentCollection $abonent
     * @return \self
     */
    public function setAbonent(SmsAbonentCollection $abonent): self{
        $this->abonent = $abonent;
        return $this;
    }

    /**
     * set message array for api
     * @return array
     */
    public function toApi(?int $key = 0): array {
        $result = [
            'sender' => $this->getSender(),
            'text' => $this->getText(),
            'abonent' => $this->getAbonent()->toApi(),
        ];
        return $result;
    }
}
