<?php

namespace USLM\Legislation\Element\LegisBody;

class Section extends LegisBodyElement {
  
  /**
  * asMarkdown()
  *
  * @return String 
  *   Markdown string representation of section and sub-elements
  *
  * @todo so much.
  *   Currently assumes there will be an enum and a header
  */
  public function asMarkdown() {
    $this->checkRequirements(array('xml'));

    //Grab the (somewhat) scalar elements
    $enum = $this->xml->enum;
    $header = $this->xml->header;

    //Create markdown string
    $markdown = "";
    $markdown .= "* __" . "$enum $header" . "__";
    
    if($text = $this->xml->text){
      $textElement = new Text();
      $textElement->simplexml($text);

      $markdown .= "\n";
      $markdown .= "  * ";
      $markdown .= $textElement->asMarkdown();
    }

    if($quoted_block = $this->xml->{'quoted-block'}){
      $element = new QuotedBlock();
      $element->simplexml($quoted_block);

      $markdown .= "\n" . $element->asMarkdown();
    }

    return $markdown;
  }
}