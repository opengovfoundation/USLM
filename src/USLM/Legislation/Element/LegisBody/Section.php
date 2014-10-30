<?php

namespace USLM\Legislation\Element\LegisBody;

use \Exception;

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

    //Grab the scalar elements
    $enum = $this->xml->enum;
    $header = $this->xml->header;

    //Create markdown string
    $markdown = "";
    $markdown .= "* __" . "$enum $header" . "__";
  
    $children = $this->xml->children();

    foreach($children as $child){
      switch($child->getName()){
        case 'text':
          $element = new Text();
          $element->simplexml($child);

          $markdown .= "\n";
          $markdown .= "  * ";
          $markdown .= $element->asMarkdown();  
          break;
        case 'quoted-block':
          $element = new QuotedBlock();
          $element->simplexml($child);

          $markdown .= "\n" . $element->asMarkdown();
          break;
        case 'paragraph':
          $element = new Paragraph();
          $element->simplexml($child);

          $markdown .= "\n" . $this->indentList($element->asMarkdown(), 2);
          break;
        case 'subsection':
          $element = new Subsection();
          $element->simplexml($child);

          $markdown .= "\n" . $this->indentList($element->asMarkdown(), 2);
          break;
        case 'enum':
        case 'header':
          break;
        default:
          throw new Exception(get_class_name($this) . " -> " . $child->getName() ." has not yet been implemented.");
      }
    }

    return $markdown;
  }
}