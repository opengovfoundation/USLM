<?php

namespace USLM\Legislation\Element;

class Externalxref extends Element{
  public function asMarkdown() {
    $this->checkRequirements('xml');

    $markdown = "*" . (string)$this->xml . "*";

    return $markdown;
  }
}