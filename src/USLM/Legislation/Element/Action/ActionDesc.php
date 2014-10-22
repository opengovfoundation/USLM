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
      $array['sponsor'] = $sponsor;
    }

    if($committeeName = $this->getCommittee()){
      $array['committee-name'] = (string)$committeeName;
    }

    if($cosponsors = $this->getCosponsors()){
      $array['cosponsors'] = $cosponsors;
    }

    return $array;
  }

  public function getSponsor(){
    if(!isset($this->xml->sponsor)){
      return false;
    }

    $sponsor = new Sponsor();
    $sponsor->simplexml($this->xml->sponsor);

    return $sponsor->toArray();
  }

  public function getCommittee(){
    if(!isset($this->xml->{'committee-name'})){
      return false;
    }

    $committeeName = new CommitteeName();
    $committeeName->simplexml($this->xml->{'committee-name'});

    return $committeeName;
  }

  public function getCosponsors(){
    if(!isset($this->xml->cosponsor)){
      return false;
    }

    $nodes = $this->xml->cosponsor;

    $array = array();

    foreach($nodes as $node){
      $cosponsor = new Cosponsor();
      $cosponsor->simplexml($node);

      array_push($array, $cosponsor->toArray());
    }

    return $array;
  }
}