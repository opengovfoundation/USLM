<?php

namespace USLM\Legislation\Element\LegisBody;

use \Exception;

class Paragraph extends LegisBodyElement {

  public function asMarkdown() {
    $this->checkRequirements(array('xml'));

    //Grab the scalar elements
    $enum = $this->xml->enum;
    $header = $this->xml->header;

    //Create markdown string
    $markdown = "";
    if($header){
      $markdown .= "* __" . "$enum $header" . "__";  
    }else{
      $markdown .= "* __" . $enum . "__";
    }
    

    if($text = $this->xml->text){
      if($header){
        $markdown .= "\n";
        $markdown .= "  * ";
      }else{
        $markdown .= " ";  
      }
      
      $element = new Text();
      $element->simplexml($text);
      
      $markdown .= $element->asMarkdown();
    }

    $children = $this->xml->children();

    foreach($children as $child){
      switch($child->getName()){
        case 'quoted-block':
          $element = new QuotedBlock();
          $element->simplexml($child);

          $markdown .= "\n" . $this->indentQuotedBlock($element->asMarkdown(), 2);
          break;
        case 'subparagraph':
          $element = new Subparagraph();
          $element->simplexml($child);

          $markdown .= "\n" . $this->indentList($element->asMarkdown(), 2);
          break;
        case 'clause': 
          $element = new Clause();
          $element->simplexml($child);

          $markdown .= "\n" . $this->indentList($element->asMarkdown(), 2);
          break;
        case 'subclause':
          $element = new Subclause();
          $element->simplexml($child);

          $markdown .= "\n" . $this->indentList($element->asMarkdown(), 4);
        case 'enum':
        case 'header':
        case 'text':
          break;
        default:
          throw new Exception(get_class($this) . " -> " . $child->getName() . " has not yet been implemented.");
      }
    }

    return $markdown;
  }
}