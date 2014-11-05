<?php
/**
* House Bill Legislation Class
*/
namespace USLM\Legislation;

use USLM\Exceptions\IncorrectXMLFormatException;

use USLM\Legislation\Element\Action\Action;
use USLM\Legislation\Element\Action\Sponsor;
use USLM\Legislation\Element\Action\Cosponsor;
use USLM\Legislation\Element\Action\Committee;

class HouseBill extends Legislation{
  const TYPE_NAME = "House Bill";
  const TYPE_CODE = "HR";
  const TYPE_BODY = "legis-body";
  const TYPE_FORM = "form";

  /**
  * Grab the array of body nodes
  *   There can potentially be more than one
  *
  * @todo Account for more than one body node
  * @return SimpleXMLElement
  */
  public function getBody()
  {
    $this->checkRequirements(array('xml'));
    
    $nodes = $this->xml->xpath(self::TYPE_BODY);

    if(!isset($nodes[0])){
      throw new IncorrectXMLFormatException("Body node index 0 not found.");
    }

    return $nodes[0];
  }

  /**
  * Grab the form node
  * @return SimpleXMLElement
  */
  public function getForm()
  {
    $this->checkRequirements(array('xml'));
    
    $formNodes = $this->xml->xpath(self::TYPE_FORM);

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
    $this->checkRequirements(array('xml'));
    
    return (string)$this->xml->attributes()['bill-stage'];
  }

  /**
  * Grab the DMS Id
  *   Note:  I think this is a unique identifier that would be the same across versions of the same bill
  */
  public function getDMSId()
  {
      $this->checkRequirements(array('xml'));

      return (string)$this->xml->attributes()['dms-id'];
  }

  /**
  * Grab the congress
  *
  * @return String
  */
  public function getCongress()
  {
      $this->checkRequirements(array('xml'));

      $nodes = $this->xml->xpath('/bill/form/congress');

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
      $this->checkRequirements(array('xml'));

      $nodes = $this->xml->xpath('/bill/form/session');

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
      $this->checkRequirements(array('xml'));

      $nodes = $this->xml->xpath('/bill/form/legis-num');

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
      $this->checkRequirements(array('xml'));

      $nodes = $this->xml->xpath('/bill/form/current-chamber');

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
      $this->checkRequirements(array('xml'));

      $nodes = $this->xml->xpath('/bill/form/legis-type');

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
      $this->checkRequirements(array('xml'));

      $nodes = $this->xml->xpath('/bill/form/official-title');

      if(count($nodes) !== 1){
        throw new IncorrectXMLFormatException("Official-title node count (" . count($nodes) . ") does not equal 1.");
      }

      return (string)$nodes[0];
  }

  /**
  * Grab all action dates
  *
  * @return false if no action dates found or array of action dates
  */
  public function getActions()
  {
    $this->checkRequirements(array('xml'));

    $actions = $this->xml->xpath('/bill/form/action');
    
    $returned = array();

    foreach($actions as $action){
      $object = new Action();
      $object->simplexml($action);

      array_push($returned, $object->toArray());
    }

    return $returned;
  }

  /**
  * Grab the sponsor
  *   Assumes only one sponsor possible
  *
  * @return Array
  */
  public function getSponsor()
  {
    $this->checkRequirements(array('xml'));

    $nodes = $this->xml->xpath('/bill/form/action/action-desc/sponsor');

    if(count($nodes) > 1){
      throw new IncorrectXMLFormatException("Sponsor node count (" . count($nodes) . ") greater than 1.");
    }

    if(count($nodes) > 0){
      $sponsor = new Sponsor();
      $sponsor->simplexml($nodes[0]);

      return $sponsor->toArray();
    }else {
      return array();
    }

    
  }

  /**
  * Grab the cosponsors
  *
  * @return Array
  */
  public function getCosponsors()
  {
      $this->checkRequirements(array('xml'));

      $nodes = $this->xml->xpath('/bill/form/action/action-desc/cosponsor');

      $array = array();

      foreach($nodes as $node){
        $cosponsor = new Cosponsor();
        $cosponsor->simplexml($node);

        array_push($array, $cosponsor->toArray());
      }

      return $array;
  }

  /**
  * Load raw XML and create simplexml element
  *
  * @return Bool true
  */
  public function loadXML($raw)
  {
      $simplexml = simplexml_load_string($raw);
      $this->simplexml($simplexml);

      return true;
  }

  /**
  * Grab the committees
  *
  * @return Array
  * @todo Currently only pulls from ActionDesc
  */
  public function getCommittees()
  {
    $this->checkRequirements(array('xml'));

    $nodes = $this->xml->xpath('/bill/form/action/action-desc/committee-name');

    $array = array();

    foreach($nodes as $node) {
      $committee = new Committee();
      $committee->simplexml($node);

      array_push($array, $committee->toArray());
    }

    return $array;
  }

  /**
  * Grab the body as markdown
  *
  * @return String (Markdown)
  */
  public function getBodyAsMarkdown()
  {
    $this->checkRequirements(array('xml'));
    $body = $this->getBody();

    $legisBody = ElementFactory::create('Structure', 'Legisbody', null, $body);

    //$legisBody = new LegisBody();
    //$legisBody->simplexml($body);

    return $legisBody->asMarkdown();
  }
}
