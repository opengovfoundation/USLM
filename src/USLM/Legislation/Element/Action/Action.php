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
    $array = array();
    $array['action-date'] = $this->getActionDate();
    $array['action-desc'] = $this->getActionDesc();

    return $array;
  }

  public function getActionDate() {
    $this->checkRequirements(array('xml'));

    $actionDate = new ActionDate();
    $actionDate->simplexml($this->xml->{'action-date'});

    return (string)$actionDate;
  }

  public function getActionDesc() {
    $this->checkRequirements(array('xml'));

    $actionDesc = new ActionDesc();
    $actionDesc->simplexml($this->xml->{'action-desc'});

    return $actionDesc->toArray();
  }
}