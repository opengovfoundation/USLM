<?php

namespace USLM\Legislation\Element;

use \Exception;

class Toc extends Element
{
    public function asMarkdown(){
      $this->checkRequirements(array('xml'));

      $markdown = "";
      $markdown = "***\n";

      $children = $this->xml->children();
      foreach($children as $child){
        $markdown .= (string)$child . "\n";
      }
      $markdown .= "***";

      return $markdown;
    }
}
