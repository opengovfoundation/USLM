<?php

namespace USLM\Legislation\Element;

use USLM\Exceptions\AttributeNotFoundException;
use \Exception;

class Element{

	public $parent;
	public $xml;

	public function __construct($type = null, $name = null, $xml = null){
    $this->type = $type;
    $this->name = $name;
    if(isset($xml)){
      $this->simplexml($xml);  
    }
	}

  //Add spaces before all list items ( indenting the list and all sub-lists )
  public function indentList($string, $spaces){
    return preg_replace('/^(\s*\*)[^*]/m', str_repeat(' ', $spaces) . "$1 ", $string);
  }

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

	protected function required($attributes){
		if(is_array($attributes)){
			foreach($attributes as $attribute){
				if(!isset($this->$attribute)){
					throw new Exception('Attribute ' . $attribute . ' isn\'t set for ' . print_r($this, true) . "\n\n Aborting.");
				}
			}
		}else{
			if(!isset($this->$attributes)){
				throw new Exception('Attribute ' . $attributes . ' isn\'t set for ' . print_r($this, true) . "\n\n Aborting.");
			}
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
    foreach($attributes as $attribute){
      if(!isset($this->$attribute)){
        throw new AttributeNotFoundException("$attribute is not defined on " . get_class($this));
      }
    }
  }
}
