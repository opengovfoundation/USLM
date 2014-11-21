<?php

namespace USLM\Legislation\Element;

class Quote extends Element {

  public function asMarkdown() {
    $this->checkRequirements('xml');

    $markdown = "\"";
    $markdown .= (string)$this->xml;
    $markdown .= "\"";

    return $markdown;
  }

}