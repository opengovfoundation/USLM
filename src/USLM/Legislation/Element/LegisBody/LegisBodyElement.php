<?php
/**
* Abstract LegisBodyElement Class
*/
namespace USLM\Legislation\Element\LegisBody;

use USLM\Legislation\Element\LegislationElement;

abstract class LegisBodyElement extends LegislationElement {
  
  abstract function asMarkdown();

  //Add spaces before all list items ( indenting the list and all sub-lists )
  public function indentList($string, $spaces){
    return preg_replace('/^(\s*\*)[^*]/m', str_repeat(' ', $spaces) . "$1 ", $string);
  }
}