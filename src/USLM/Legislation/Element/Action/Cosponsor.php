<?php

namespace USLM\Legislation\Element\Action;

use USLM\Legislation\Element\LegislationElement;

class Cosponsor extends LegislationElement{

  public function toArray() {
    $this->checkRequirements(array('xml'));

    $array = array();

    $array['name-id'] = (string)$this->xml->attributes()['name-id'];
    $array['name'] = (string)$this->xml;

    return $array;
  }

  public function __toString(){
    $this->checkRequirements(array('xml'));

    return (string)$this->xml;
  }
}