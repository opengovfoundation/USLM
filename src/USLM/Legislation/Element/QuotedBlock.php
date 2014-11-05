<?php

namespace USLM\Legislation\Element;

use \Exception;

class Quotedblock extends Element {

  public function asMarkdown() {
    $this->checkRequirements(array('xml'));

    $after = (string)$this->xml->{'after-quoted-block'};

    $block = $this->xml;
    unset($block->{'after-quoted-block'});

    $markdown = "";
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
        case 'subparagraph':
          $element = new Subparagraph();
          break;
        case 'clause':
          $element = new Clause();
          break;
        case 'quoted-block-continuation-text':
          $element = new QuotedBlockContinuationText();
          break;
        case 'toc':
          $element = new TOC();
          break;
        case 'text':
          $element = new Text();
          break;
        default:
          throw new Exception(get_class($this) . ' -> ' . $child->getName() . ' has not yet been implemented.');
      }

      $element->simplexml($child);
      $childMarkdown = $this->stripMarkdownStyling($element->asMarkdown());
      $childMarkdown = $this->addBlockQuoteMarkers($childMarkdown);
      $markdown .= "$childMarkdown\n";
    }

    //Trim trailing spaces / newlines if present
    $markdown = rtrim($markdown);
    
    if((bool)$after){
      $markdown .= "\n" . (string)$after;
    }

    return $markdown;
  }

  /**
  * addBlockQuoteMarkers()
  *   Adds '>' characters for block quote styling
  *
  * @param String
  * @return String
  */
  public function addBlockQuoteMarkers($markdown){
    $markdown = preg_replace('/^/m', '> ', $markdown);

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
    
    //Strip leading ***
    $markdown = preg_replace('/^\s*\*\*\*\n?/m', '', $markdown);

    //Strip list styling
    $markdown = preg_replace('/^(\s*)\*\s/m', '$1', $markdown);

    //Strip emphasis around enums
    $markdown = preg_replace('/^(\s*)__([^\s]+)__/m', '$1$2', $markdown);

    //Remove bold styling wrapping lines
    $markdown = preg_replace('/^__(.*?)__$/m', '$1', $markdown);

    //Trim trailing spaces / newlines
    $markdown = rtrim($markdown);

    return $markdown;
  }
}