<?php

namespace USLM\Legislation\Element\Action;

use USLM\Legislation\Element\LegislationElement;

class Cosponsor extends LegislationElement{

  public function __toString(){
    $this->checkRequirements(array('xml'));

    return (string)$this->xml;
  }
}