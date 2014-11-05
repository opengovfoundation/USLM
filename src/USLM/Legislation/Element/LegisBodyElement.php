<?php
/**
* Abstract LegisBodyElement Class
*/
namespace USLM\Legislation\Element;

use USLM\Legislation\Element\LegislationElement;

abstract class LegisBodyElement extends LegislationElement {
  
  abstract function asMarkdown();

  //Add spaces before all list items ( indenting the list and all sub-lists )
  public function indentList($string, $spaces){
    return preg_replace('/^(\s*\*)[^*]/m', str_repeat(' ', $spaces) . "$1 ", $string);
  }

  public function indentQuotedBlock($string, $spaces){
    return preg_replace('/^(\s*>\s)/m', str_repeat(' ', $spaces) . "$1", $string);
  }
}