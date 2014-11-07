<?php

namespace USLM\Legislation\Element;

use \Exception;

class Listitem extends Element{
  public function asMarkdown() {
    $this->checkRequirements('xml');

    $markdown = (string)$this->xml;
    $markdown = preg_replace('/\n\s+/m', ' ', $markdown);
    $markdown = "• " . $markdown;

    return $markdown;
  }
}