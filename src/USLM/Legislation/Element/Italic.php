<?php

namespace USLM\Legislation\Element;

class Italic extends Element{
  public function selfMarkdown(){
    $this->checkRequirements('xml');

    $markdown = "*" . (string)$this->xml . "*";

    return $markdown;
  }
}