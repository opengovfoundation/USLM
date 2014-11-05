<?php

namespace USLM\Legislation\Structures;

class ElementFactory{
  
  public static function createStructure($name, $xml){
    $type = 'Structure';

    return $this->createElement($type, $name, $xml);
  }

  public static function createNonStructure($name, $xml){
    $type = 'Nonstructure';

    return $this->createElement($type, $name, $xml);
  }

  protected function createElement($type, $name, $xml){
    $name = ucfirst($name);

    return new Element($type, $name, $xml);
  }
}