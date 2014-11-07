<?php

namespace USLM\Legislation;

use USLM\Legislation\Element\Element;
use \Exception;

class ElementFactory{

  public static function create($type, $name, $parent, $xml){
    $type = ucfirst($type);

    return static::createElement($type, $name, $parent, $xml);
  }

  protected static function createElement($type, $name, $parent, $xml){
    $name = str_replace('-', '', $name);

    //Hack because we can't create a 'List' class as it's a php reserved keyword.
    $name = $name === 'list' ? 'listt' : $name;

    $name = 'USLM\\Legislation\\Element\\' . ucfirst($name);

    if(class_exists($name)){
      $element = new $name($type, $name, $parent, $xml);

      return $element;
    }else{
      throw new Exception("Class $name does not exist.");
    }
  }
}