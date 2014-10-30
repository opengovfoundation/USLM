<?php

namespace USLM\Legislation\Element\LegisBody;

use \Exception;

class QuotedBlock extends LegisBodyElement {

  public function asMarkdown() {
    $this->checkRequirements(array('xml'));

    $after = (string)$this->xml->{'after-quoted-block'};

    $block = $this->xml;
    unset($block->{'after-quoted-block'});

    $markdown = "";
    $markdown .= "***\n";
    $children = $this->xml->children();

    foreach($children as $child){
      switch($child->getName()){
        case 'paragraph':
          $element = new Paragraph();
          break;
        case 'section':
          $element = new Section();
          break;
        case 'subsection':
          $element = new Subsection();
          break;
        default:
          throw new Exception(get_class($this) . ' -> ' . $child->getName() . ' has not yet been implemented.');
      }

      $element->simplexml($child);
      $markdown .= $this->stripMarkdownStyling($element->asMarkdown());
    }
    
    $markdown .= "\n***";
    
    if((bool)$after){
      $markdown .= "\n" . (string)$after;
    }

    return $markdown;
  }

  /**
  * stripMarkdownStyling
  *   Remove styling from quoted block content.
  *   Strips leading *, __, and lines wrapped in __[content]__
  *
  * @param String
  * @return String
  */
  public function stripMarkdownStyling($markdown) {
    //Strip leading spaces, *, __
    $markdown = preg_replace('/^[\s\*]*/m', '', $markdown);
    $markdown = preg_replace('/^__([^\s]+)__/m', '$1', $markdown);

    //Remove bold styling wrapping lines
    $markdown = preg_replace('/^__(.*?)__$/m', '$1', $markdown);

    return $markdown;
  }
}