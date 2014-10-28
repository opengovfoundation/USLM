<?php

namespace USLM\Legislation\Element\LegisBody;

class Text extends LegisBodyElement {

  public function asMarkdown() {
    $this->checkRequirements(array('xml'));

    $markdown = $this->xml->asXML();
    $markdown = preg_replace('/<\/?quote>/', '"', $markdown);
    $markdown = strip_tags($markdown);

    return $markdown;
  }
}