<?php
/**
* ActionDate element class
*
* Heirarchy:
* (%pcd-model)*
*
*/
namespace USLM\Legislation\Element\Action;

use USLM\Legislation\Element\LegislationElement;

class ActionDate extends LegislationElement{

  public function toString(){
    $this->checkRequirements(array('xml'));

    return (string)$this->xml;
  }
}