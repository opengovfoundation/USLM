<?php
/**
* ActionDesc element class
*
* Heirarchy:
* (%pcd-model; | %phrase-level; | committee-name | cosponsor | sponsor | nonsponsor)*
*
* @todo A list of assumptions ( which are don't account for the true spec detailed above ):
*   * We will have only one sponsor
*   * NOTE: Right now we only account for one committee
*/
namespace USLM\Legislation\Element\Action;

use USLM\Legislation\Element\LegislationElement;

class ActionDesc extends LegislationElement{
  public function toArray(){
    $this->checkRequirements(array('xml'));

    $array = array();

    //Cannot simple cast to a string.  This won't include child element text.
    $array['text'] = strip_tags($this->xml->asXML());

    if($sponsor = $this->getSponsor()){
      $array['sponsor'] = (string)$sponsor;
    }

    if($committeeName = $this->getCommittee()){
      $array['committee-name'] = (string)$committeeName;
    }

    if($cosponsor = $this->getCosponsor()){
      if(is_array($cosponsor)){
        $cosponsors = array();

        foreach($cosponsor as $object){
          array_push($cosponsors, (string)$object);
        }

        $array['cosponsor'] = $cosponsors;
      }else{
        $array['cosponsor'] = (string)$cosponsor;
      }
    }

    return $array;
  }

  public function getSponsor(){
    if(!isset($this->xml->sponsor)){
      return false;
    }

    $sponsor = new Sponsor();
    $sponsor->simplexml($this->xml->sponsor);

    return $sponsor;
  }

  public function getCommittee(){
    if(!isset($this->xml->{'committee-name'})){
      return false;
    }

    $committeeName = new CommitteeName();
    $committeeName->simplexml($this->xml->{'committee-name'});

    return $committeeName;
  }

  public function getCosponsor(){
    if(!isset($this->xml->cosponsor)){
      return false;
    }

    $element = $this->xml->cosponsor;

    if($element->count() === 1){
      $cosponsor = new Cosponsor();
      $cosponsor->simplexml($element);
    } else {
      $cosponsor = array();
      
      foreach($element as $object){
        $toAdd = new Cosponsor();
        $toAdd->simplexml($object);
        array_push($cosponsor, $toAdd);
      }
    }
    
    return $cosponsor;
  }
}