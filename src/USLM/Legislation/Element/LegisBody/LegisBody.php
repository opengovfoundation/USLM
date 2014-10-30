<?php
/**
* LegisBody element class
*
*/
namespace USLM\Legislation\Element\LegisBody;

use \Exception;

class LegisBody extends LegisBodyElement{

  public function asMarkdown() {
    $this->checkRequirements(array('xml'));

    $children = $this->xml->children();

    $markdown = "";

    foreach($children as $child){
      switch($child->getName()) {
        case 'section':
          $section = new Section();
          $section->simplexml($child);
          $markdown .= $section->asMarkdown();
          $markdown .= "\n";
          break;
        case 'division':
          throw new Exception("LegisBody -> Division has not yet been implemented.");
          break;
        case 'title':
          throw new Exception("LegisBody -> Title has not yet been implemented.");
          break;
        default:
          throw new Exception("Unknown LegisBody child " . $child->getName());
      }
    }

    return $markdown;
  }
}