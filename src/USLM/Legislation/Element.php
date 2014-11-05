<?php

namespace USLM\Legislation;

class Element{
  
  public function __construct($type, $name, $xml){
    $this->type = $type;
    $this->name = $name;
    $this->simplexml($xml);
  }

  public function simplexml($xml){
    if(get_class($xml) === 'SimpleXMLElement'){
      $this->xml = $xml;  
    }elseif(gettype($xml) === "string"){
      $this->xml = simplexml_load_string($xml);
    }else{
      throw new Exception("Cannot load " . gettype($xml) . " as simplexml object.");
    }
  }
}