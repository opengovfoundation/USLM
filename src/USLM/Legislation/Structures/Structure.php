<?php

namespace USLM\Legislation\Structures;

class Structure extends Element{

  public $type = "Structure";

  public function __construct($type, $xml = null){
    if(isset($xml)){
      $this->simplexml($xml);  
    }

    $this->type = $type;
  }

  /**
  * getHeader()
  * 
  * Return element header
  *   Returns false if header doesn't exist
  *
  * @param $asString (default true)
  * @return SimpleXMLElement || String || false
  */
  public function getHeader($asString = true){
    if($asString){
      return (string)$this->xml->header || false;
    }else{
      return $this->xml->header || false;
    }
  }

  /**
  * getEnum()
  * 
  * Return element enum
  *   Returns false if enum doesn't exist
  *
  * @param $asString (default true)
  * @return SimpleXMLElement || String || false
  */
  public function getEnum($asString = true){
    if($asString){
      return (string)$this->xml->header || false;
    }else{
      return $this->xml->header || false;
    }
  }

  /**
  * getType()
  *
  * Returns element type
  */
  public function getType(){
    return $this->type;
  }

  /**
  * getChildren()
  *
  * Returns array of children
  */
  public function getChildren(){
    //Return children
  }
}