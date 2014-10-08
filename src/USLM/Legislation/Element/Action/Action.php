<?php
/**
* Action element class
*
* Child Elements:
* (action-date?, (action-desc | action-instruction)*)
*
* @todo There are currently quite a few assumptions that, according to the offical DTD, could very well be false
*   * We will only have one 'sponsor'
*   * There will only be one 'action-desc'
*   * We currently don't handle 'action-instruction'
*/
namespace USLM\Legislation\Element\Action;

use USLM\Legislation\Element\LegislationElement;

class Action extends LegislationElement{

  public function toArray(){
    $this->parseElement();

    $array = array();
    $array['action-date'] = $this->actionDate->toString();
    $array['action-desc'] = $this->actionDesc->toArray();

    return $array;
  }

  public function parseElement(){
    $this->checkRequirements(array('xml'));

    $this->actionDate = $this->setActionDate();
    $this->actionDesc = $this->setActionDesc();
  }

  public function setActionDate(){
    $actionDate = new ActionDate();
    $actionDate->simplexml($this->xml->{'action-date'});
    
    return $actionDate;
  }

  public function setActionDesc(){
    $actionDesc = new ActionDesc();
    $actionDesc->simplexml($this->xml->{'action-desc'});

    return $actionDesc;
  }
}