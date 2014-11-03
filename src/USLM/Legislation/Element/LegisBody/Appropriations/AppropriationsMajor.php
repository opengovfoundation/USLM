<?php

namespace USLM\Legislation\Element\LegisBody\Appropriations;

use USLM\Legislation\Element\LegisBody\LegisBodyElement;

class AppropriationsMajor extends LegisBodyElement{

  public $header = "####";

  public function asMarkdown() {
    $this->checkRequirements(array('xml'));

    $markdown = $this->header . ' ' . trim(strip_tags($this->xml->asXML()));
    
    return $markdown;
  }
}