<?php
/**
*	XML Converter for the House of Representatives Bulk XML Legislation
* Currently only handles HR Bills
*/

namespace USLM;

use USLM\Exceptions\IncorrectXMLFormatException;
use USLM\Exceptions\IncorrectArgumentCountException;
use USLM\Exceptions\FileNotFoundException;
use SimpleXMLElement;

class USLM{
	const ROOTTAG = 'legis-body';

	protected $structure = array(
					'section',
					'subsection',
					'paragraph',
					'subparagraph',
					'clause',
					'subclause',
					'item'
				);

	public $originalXML;
	public $md = '';
	protected $simplexml;

	public function __construct($xml = null){
        if(isset($xml)){
            $this->originalXML = $xml;
            try{
              $this->simplexml = simplexml_load_string($xml);  
            } catch (Exception $e) {
              throw new IncorrectXMLFormatException($e->getMessage());
            }
        }
	}

  public function setXML($xml){
      $this->originalXML = $xml;

      try{
        $this->simplexml = simplexml_load_string($xml);  
      } catch (Exception $e) {
        throw new IncorrectXMLFormatException($e->getMessage());
      }
      
  }

  public function getTitle(){
    $metas = $this->simplexml->metadata->dublinCore->children('http://purl.org/dc/elements/1.1/');

    //Replace non-ascii characters
    $title = iconv("utf-8", "utf-8//ignore", $metas->title);

    return (string)$title;
  }

	public function getBody(){
    if(!isset($this->simplexml) && gettype($this->simplexml) !== 'SimpleXMLElement'){
      throw new Exception('SimpleXML not set, cannot get body of document.  Type = ' . gettype($this->simplexml));
    }

    $rootNode = $this->simplexml->xpath(self::ROOTTAG);
    if(!isset($rootNode[0])){
      throw new IncorrectXMLFormatException('Root node index 0 not found');
    }
		$rootNode = $rootNode[0];

		if(!isset($rootNode)){
			throw new Exception("Unable to get simplexml root node.  Tag: " . self::ROOTTAG);
		}

		$markdown = $this->convertChildren($rootNode, 0);

    //Remove non-ascii characters
		//$this->md = preg_replace("/[^\x01-\x7F]/","", $markdown);
    $this->md = iconv("utf-8", "utf-8//ignore", $markdown);

		return $this->md;
	}

  public function createslug($title)
  {
      //Remove non-ascii characters
      $slug = str_replace(array(' ', '.', ':', ','), array('-', '', '', ''), strtolower($title));

      return iconv("utf-8", "utf-8//ignore", $slug);
  }

  public function getSponsor()
  {
      $sponsor = $this->simplexml->xpath('form//sponsor');

      if(empty($sponsor)){
        return null;
      }

      return iconv("utf-8", "utf-8//ignore", (string)$sponsor[0]);
  }

  public function getStatus()
  {
      $status = $this->simplexml->attributes()['bill-stage'];
      $status = str_replace('-', ' ', (string)$status);
      
      return iconv("utf-8", "utf-8//ignore", $status);
  }

  public function getCommittee()
  {
      $commitee_name = $this->simplexml->xpath('//committee-name');

      if(empty($committe_name)){
        return null;
      }

      return iconv("utf-8", "utf-8//ignore", (string)$commitee_name[0]);
  }

	protected function convertChildren($node, $index){
		$nodeList = $node->xpath('section');
		$mdString = '';

		foreach($nodeList as $nodes){
			$section = new Structure('section');
			$section->level(0);

			$section->simplexml($nodes);
			$section->parseSelf();
			$mdString .= $section->toMarkdown();
		}

		return $mdString;
	}

	protected function dd()
	{
		array_map(function($x) { var_dump($x); }, func_get_args()); die;
	}

	protected function count_beg_chars($string, $char){
		$i = 0;
		echo "Starts with |" . $string{$i} . "|\n";

		while($string{$i} == $char){
			echo "|" .$string{$i} . "| ?= |" . $char . "|\n";
			$i++;
		}

		return $i;
	}
}
