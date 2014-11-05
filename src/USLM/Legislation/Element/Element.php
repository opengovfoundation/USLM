<?php

namespace USLM\Legislation\Element;

use USLM\Legislation\ElementFactory;

use USLM\Exceptions\AttributeNotFoundException;
use \Exception;

class Element{

	public $parent;
	public $xml;

	public function __construct($type = null, $name = null, $parent = null, $xml = null){
    $this->type = $type;
    $this->name = $name;
    $this->parent = $parent;
    if(isset($xml)){
      $this->simplexml($xml);  
    }
	}

  public function asMarkdown(){
    $this->checkRequirements(array('xml'));

    $markdown = $this->selfMarkdown();
    $markdown .= $this->childrenMarkdown();
    
    if($this->parent !== null){
      $markdown = $this->indent($markdown, 2);
    }

    return $markdown;
  }

  public function selfMarkdown(){
    $this->checkRequirements('xml');

    $enum = $this->xml->enum;
    $header = $this->xml->header;
    $text = $this->xml->text;

    $markdown = "";

    if(!$enum && !$header && !$text){
      $markdown .= (string)$this->xml;
      return $markdown;
    }else if(!$enum && !$header){
      $text = new Text();
      $markdown .= "* " . $text->asMarkdown();
    }else if(!$text){
      $markdown .= "* $enum $header";
    }else{
      $markdown .= "* $enum $header";
      $markdown .= "*  $text";
    }

    return trim($markdown);
  }

  public function childrenMarkdown(){
    $children = $this->xml->children();

    $markdown = "";

    foreach($children as $child){
      $name = $child->getName();

      $element = ElementFactory::create('Unknown', $name, $this, $child);

      $markdown .= $element->asMarkdown();
      $markdown .= "\n";
    }

    $markdown = rtrim($markdown, "\n");

    return $markdown;
  }

  //Indent a block of text
  public function indent($string, $spaces){
    return preg_replace('/^/m', str_repeat(' ', $spaces), $string);
  }

  //Add spaces before all list items ( indenting the list and all sub-lists )
  public function indentList($string, $spaces){
    return preg_replace('/^(\s*\*)[^*]/m', str_repeat(' ', $spaces) . "$1 ", $string);
  }

  //Add spaces before all quoted block lines ( indenting any lines starting with >)
  public function indentQuotedBlock($string, $spaces){
    return preg_replace('/^(\s*>\s)/m', str_repeat(' ', $spaces) . "$1", $string);
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

	protected function accessor($attribute, $value = null){
		if(!isset($attribute)){
			throw new Exception('Attribute not set for accessor method.  Aborting');
		}

		if(!isset($value)){
			return $this->$attribute;
		}else{
			$this->$attribute = $value;
		}
	}

	/**
  * Helper method to verify an array of necessary attributes
  *   If any of the attributes don't exist, throw an exception
  */
  protected function checkRequirements($attributes){
    if(is_array($attributes)){
      foreach($attributes as $attribute){
        if(!isset($this->$attribute)){
          throw new AttributeNotFoundException("$attribute is not defined on " . get_class($this));
        }
      }
    }else{
      if(!isset($this->$attributes)){
        throw new AttributeNotFoundException("$attributes is not defined on " . get_class($this));
      }
    }
    
  }
}
