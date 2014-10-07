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
  * @return SimpleXMLElement
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
  * @return SimpleXMLElement
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

  /**
  * Grab the bill stage
  *
  * @return String
  */
  public function getBillStage()
  {
    $this->checkRequirements(array('simplexml'));
    
    return (string)$this->simplexml->attributes()['bill-stage'];
  }

  /**
  * Helper method to verify an array of necessary attributes
  *   If any of the attributes don't exist, throw an exception
  */
  private function checkRequirements($attributes){
    foreach($attributes as $attribute){
      if(!isset($this->$attribute)){
        throw new AttributeNotFoundException("$attribute is not defined.");
      }
    }
  }

  /**
  * Grab the DMS Id
  *   Note:  I think this is a unique identifier that would be the same across versions of the same bill
  */
  public function getDMSId()
  {
      $this->checkRequirements(array('simplexml'));

      return (string)$this->simplexml->attributes()['dms-id'];
  }

  /**
  * Grab the congress
  *
  * @return String
  */
  public function getCongress()
  {
      $this->checkRequirements(array('simplexml'));

      $nodes = $this->simplexml->xpath('/bill/form/congress');

      if(count($nodes) !== 1){
        throw new IncorrectXMLFormatException("Congress node count (" . count($nodes) . ") does not equal 1.");
      }

      return (string)$nodes[0];
  }

  /**
  * Grab the congressional session
  *
  * @return String
  */
  public function getSession()
  {
      $this->checkRequirements(array('simplexml'));

      $nodes = $this->simplexml->xpath('/bill/form/session');

      if(count($nodes) !== 1){
        throw new IncorrectXMLFormatException("Session node count(" . count($nodes) . ") does not equal 1.");
      }

      return (string)$nodes[0];
  }

  /**
  * Grab the Legis-Num
  *
  * @return String
  */
  public function getLegisNum()
  {
      $this->checkRequirements(array('simplexml'));

      $nodes = $this->simplexml->xpath('/bill/form/legis-num');

      if(count($nodes) !== 1){
        throw new IncorrectXMLFormatException("Legis-num node count (" . count($nodes) . ") does not equal 1.");
      }

      return (string)$nodes[0];
  }

  /**
  * Grab the current chamber
  *
  * @return String
  */
  public function getCurrentChamber()
  {
      $this->checkRequirements(array('simplexml'));

      $nodes = $this->simplexml->xpath('/bill/form/current-chamber');

      if(count($nodes) !== 1){
        throw new IncorrectXMLFormatException("Current-chamber node count (" . $count($nodes) . ") does not equal 1.");
      }

      return (string)$nodes[0];
  }

  /**
  * Grab the legis-type
  *
  * @return String
  */
  public function getLegisType()
  {
      $this->checkRequirements(array('simplexml'));

      $nodes = $this->simplexml->xpath('/bill/form/legis-type');

      if(count($nodes) !== 1){
        throw new IncorrectXMLFormatException("Legis-type node count (" . $count($nodes) . ") does not equal 1.");
      }

      return (string)$nodes[0];
  }

  /**
  * Grab the official title
  *
  * @return String
  */
  public function getOfficialTitle()
  {
      $this->checkRequirements(array('simplexml'));

      $nodes = $this->simplexml->xpath('/bill/form/official-title');

      if(count($nodes) !== 1){
        throw new IncorrectXMLFormatException("Official-title node count (" . $count($nodes) . ") does not equal 1.");
      }

      return (string)$nodes[0];
  }
}
