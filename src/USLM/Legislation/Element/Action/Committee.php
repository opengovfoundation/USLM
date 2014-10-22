<?php

namespace USLM\Legislation\Element\Action;

use USLM\Legislation\Element\LegislationElement;

class Committee extends LegislationElement{

  public function toArray() {
    $this->checkRequirements(array('xml'));

    $array = array();
    
    $array['committee-id'] = (string)$this->xml->attributes()['committee-id'];
    $array['committee-name'] = (string)$this->xml;

    return $array;
  }

  public function __toString(){
    $this->checkRequirements(array('xml'));

    return (string)$this->xml;
  }
}