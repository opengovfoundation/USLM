<?php

namespace USLM\Legislation\Element\LegisBody;

class QuotedBlock extends LegisBodyElement {

  public function asMarkdown() {
    $this->checkRequirements(array('xml'));

    $after = (string)$this->xml->{'after-quoted-block'};

    $block = $this->xml;
    unset($block->{'after-quoted-block'});

    $markdown = "";
    $markdown .= "***\n";
    $markdown .= preg_replace('/^\s+/m', '', trim(strip_tags($block->asXML())));
    $markdown .= "\n***";
    
    if((bool)$after){
      $markdown .= "\n" . (string)$after;
    }

    return $markdown;
  }
}