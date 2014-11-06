<?php

namespace USLM\Legislation\Structures;

class StructureFactory{
  
  public static function createStructure($type, $xml){
    $baseClass = 'Structure';
    $targetClass = ucfirst($type);

    if(class_exists($targetClass) && is_subclass_of($targetClass, $baseClass)){
      return new $targetClass($xml);
    }else{
      throw new Exception("The structure type '$type' does not exist.");
    }
  }
}