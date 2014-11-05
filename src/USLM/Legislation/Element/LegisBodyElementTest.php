<?php
/**
* Concrete class used exclusively to test the LegisBodyElement Abstract class 
*/

namespace USLM\Legislation\Element;

class LegisBodyElementTest extends LegisBodyElement {
  public function asMarkdown() {
    return false;
  }
}