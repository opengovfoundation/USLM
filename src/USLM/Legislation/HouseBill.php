<?php
/**
* House Bill Legislation Class
*/
namespace USLM\Legislation;

use USLM\Exceptions\IncorrectXMLFormatException;

class HouseBill extends Legislation{
  const TYPE_NAME = "House Bill";
  const TYPE_CODE = "HR";
  const TYPE_BODY = "legis-body";
  const TYPE_FORM = "form";

  public function loadXML($raw)
  {
    $this->raw = $raw;

    try{
      $this->simplexml = simplexml_load_string($this->raw);
    }catch(Exception $e){
      throw new IncorrectXMLFormatException($e->getMessage());
    }

    return true;
  }

  /**
  * Grab the array of body nodes
  *   There can potentially be more than one
  *
  * @todo Account for more than one body node
  */
  public function getBody()
  {
    $this->checkRequirements(array('simplexml'));
    
    $bodyNodes = $this->simplexml->xpath(self::TYPE_BODY);

    if(!isset($bodyNodes[0])){
      throw new IncorrectXMLFormatException("Body node index 0 not found.");
    }

    return $bodyNodes[0];
  }

  /**
  * Grab the form node
  */
  public function getForm()
  {
    $this->checkRequirements(array('simplexml'));
    
    $formNodes = $this->simplexml->xpath(self::TYPE_FORM);

    if(count($formNodes) !== 1){
      throw new IncorrectXMLFormatException("Form node count (" . count($formNodes) . ") does not equal 1.");
    }

    return $formNodes[0];
  }

  public function getBillStage()
  {
    $this->checkRequirements(array('simplexml'));
    
    return (string)$this->simplexml->attributes()['bill-stage'];
  }

  private function checkRequirements($attributes){
    foreach($attributes as $attribute){
      if(!isset($this->$attribute)){
        throw new AttributeNotFoundException("$attribute is not defined.");
      }
    }
  }
}
