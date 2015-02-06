<?php

namespace USLM\Legislation\Element;

use \Exception;

class Quotedblock extends Element {

  public function asMarkdown() {
    $this->checkRequirements(array('xml'));

    $after = $this->xml->{'after-quoted-block'};

    $markdown = $this->selfMarkdown();
    
    $childMarkdown = $this->childrenMarkdown();
    
    if($childMarkdown){
      $markdown .= "\n$childMarkdown";
    }

    $markdown = trim($markdown);

    $markdown = $this->stripMarkdownStyling($markdown);
    $markdown = $this->addBlockQuoteMarkers($markdown);
    $markdown = "\n" . $markdown . "\n" . (string)$after;
    //$markdown .= "\n" . (string)$after;

    if($this->parent != null){
      $markdown = $this->indent($markdown, 2);
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
    $markdown = preg_replace('/^(\s*)__(.*?)__$/m', '$1$2', $markdown);

    //Trim trailing spaces / newlines
    $markdown = rtrim($markdown);

    return $markdown;
  }
}