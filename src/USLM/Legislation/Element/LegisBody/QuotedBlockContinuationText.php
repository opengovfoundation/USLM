<?php

namespace USLM\Legislation\Element\LegisBody;

class QuotedBlockContinuationText extends LegisBodyElement{

  public function asMarkdown() {
    $this->checkRequirements(array('xml'));

    $markdown = (string)$this->xml->asXML();
    $markdown = preg_replace('/<\/?term>/m', '"', $markdown);
    $markdown = strip_tags($markdown);
    $markdown = preg_replace('/^\s+/m', ' ', $markdown);
    $markdown = preg_replace('/\n/m', '', $markdown);

    return $markdown;
  }

}