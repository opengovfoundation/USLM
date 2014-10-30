<?php

namespace USLM\Legislation\Element\LegisBody;

use \Exception;

class TOC extends LegisBodyElement
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
