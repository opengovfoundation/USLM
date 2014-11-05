<?php

namespace USLM\Legislation\Element;

class Appropriationsmajor extends Element{

  public $header = "####";

  public function asMarkdown() {
    $this->checkRequirements(array('xml'));

    $markdown = $this->header . ' ' . trim(strip_tags($this->xml->asXML()));
    
    return $markdown;
  }
}