<?php
/**
* Abstract LegisBodyElement Class
*/
namespace USLM\Legislation\Element\LegisBody;

use USLM\Legislation\Element\LegislationElement;

abstract class LegisBodyElement extends LegislationElement {
  
  abstract function asMarkdown();
}