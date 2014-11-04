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

          $markdown .= "\n" . $this->indentQuotedBlock($element->asMarkdown(), 2);
          break;
        case 'paragraph':
          $element = new Paragraph();
          $element->simplexml($child);

          $markdown .= "\n" . $this->indentList($element->asMarkdown(), 2);
          break;
        case 'toc':
          $element = new TOC();
          $element->simplexml($child);
          $markdown .= "\n" . $element->asMarkdown();
          break;
        case 'subsection':
          $element = new Subsection();
          $element->simplexml($child);

          $markdown .= "\n" . $this->indentList($element->asMarkdown(), 2);
          break;
        case 'appropriations-major':
        case 'appropriations-intermediate':
        case 'appropriations-small':
          //e.g. 'appropriations-major' -> USLM\Legislation\Element\Appropriations\AppropriationsMajor
          $class_name = "USLM\\Legislation\\Element\\LegisBody\\Appropriations\\" . str_replace(' ', '', ucwords(str_replace('-', ' ', $child->getName())));
          
          $element = new $class_name(); 
          $element->simplexml($child);

          $markdown .= "\n" . $element->asMarkdown();
          break;
        case 'enum':
        case 'header':
          break;
        default:
          throw new Exception(get_class($this) . " -> " . $child->getName() ." has not yet been implemented.");
      }
    }

    return $markdown;
  }
}