<?php

namespace USLM\Legislation\Element\LegisBody;

class Text extends LegisBodyElement {

  public function asMarkdown() {
    $this->checkRequirements(array('xml'));

    $markdown = $this->xml->asXML();
    $markdown = preg_replace('/<\/?quote>/', '"', $markdown);
    $markdown = preg_replace('/<\/?term>/', '"', $markdown);
    $markdown = strip_tags($markdown);
    $markdown = preg_replace('/\s*\n\s*/', ' ', $markdown);
    $markdown = trim(html_entity_decode($markdown));


    return $markdown;
  }
}