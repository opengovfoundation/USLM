<?php

namespace USLM\Legislation;

use USLM\Legislation\Element\Element;
use \Exception;

class ElementFactory{

  public static function create($type, $name, $xml){
    $type = ucfirst($type);

    return static::createElement($type, $name, $xml);
  }
  
  public static function createStructure($name, $xml){
    $type = 'Structure';

    return static::createElement($type, $name, $xml);
  }

  public static function createNonStructure($name, $xml){
    $type = 'Nonstructure';

    return static::createElement($type, $name, $xml);
  }

  protected static function createElement($type, $name, $xml){
    $name = 'USLM\\Legislation\\Element\\' . ucfirst($name);

    if(class_exists($name)){
      $element = new $name($type, $name, $xml);

      return $element;
    }else{
      throw new Exception("Class $name does not exist.");
    }
  }
}