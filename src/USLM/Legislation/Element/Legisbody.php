<?php
/**
* LegisBody element class
*
*/
namespace USLM\Legislation\Element;

use \Exception;

class Legisbody extends Element{

  public function asMarkdown() {
    $this->checkRequirements(array('xml'));

    $children = $this->xml->children();

    $markdown = "";

    foreach($children as $child){
      switch($child->getName()) {
        case 'section':
          $element = new Section();
          break;
        case 'division':
          $element = new Division();
          break;
        case 'title':
        default:
          throw new Exception(get_class($this) . " -> " . $child->getName() . " has not yet been implemented.");
      }
      
      $element->simplexml($child);
      $markdown .= $element->asMarkdown();
      $markdown .= "\n";
    }

    $markdown = rtrim($markdown, "\n");

    return $markdown;
  }
}