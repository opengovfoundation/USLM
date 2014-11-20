<?php

namespace USLM\Legislation\Element;

class Table extends Element
{
  /**
  * getBodyAsMarkdown
  *   Return table body as markdown
  *
  * @param void
  * @return String
  */
  public function asMarkdown() {
    $this->checkRequirements('xml');

    $headers = $this->getHeaders();
    $body = $this->getBody();

    $markdown = $this->tableToMarkdown($body, $headers);

    return $markdown;
  }

  /**
  * getBody()
  *
  * Return table body as multidimensional array 
  *
  * @param void
  * @return Array
  */
  public function getBody(){
    $this->checkRequirements('xml');

    $tbody = $this->xml->tgroup->tbody;

    $body = array();

    foreach($tbody->row as $trow){
      $row = array();

      foreach($trow as $cell){
        $content = $this->parseEntry($cell);

        array_push($row, $content);
      }

      array_push($body, $row);
    }

    return $body;
  }

  /**
  * getHeaders()
  *
  * Return array of header strings
  *
  * @param void
  * @return Array
  */
  public function getHeaders(){
    $this->checkRequirements('xml');

    $header = $this->xml->tgroup->thead;

    if(!$header){
      return false;
    }

    $headerRows = $header->row;
    
    if($headerRows > 1){
      throw new Exception("Table class cannot handle multiple header rows.");
    }

    $headers = array();

    foreach($headerRows->entry as $header){
      $content = (string)$header;

      array_push($headers, $content);
    }

    return $headers;
  }

  /**
  * tableToMarkdown
  *   return multidimensional table array as markdown string
  *
  * @param Array $body
  * @param Array $headers
  * @return String
  */
  public function tableToMarkdown($body, $headers){
    $markdown = "";

    $columns = count($body[0]);

    $tableArray = $body;

    if($headers){
      array_push($tableArray, $headers);  
    }

    $widths = $this->getColumnWidths($tableArray);
    $totalWidth = $this->getTableWidth($widths, $columns);

    if($headers){
      $markdown .= $this->rowToMarkdown($headers, $widths) . "\n";  
    }

    $markdown .= str_repeat('-', $totalWidth) . "\n";

    foreach($body as $row){
      $markdown .= $this->rowToMarkdown($row, $widths) . "\n";
    }

    $markdown .= str_repeat('-', $totalWidth); 

    return trim($markdown);
  }

  /**
  * getColumnWidths
  *   Returns array of max width values for each column
  *
  * @param Array
  * @return Array
  */
  public function getColumnWidths($table){
    $widths = array();

    foreach($table as $row){
      foreach($row as $index => $cell){
        if(!isset($widths[$index])){
          $widths[$index] = mb_strlen($cell, "UTF-8");
        }else{
          if(mb_strlen($cell, "UTF-8") > $widths[$index]){
            $widths[$index] = mb_strlen($cell, "UTF-8");
          }
        }
      }
    }

    return $widths;
  }

  /**
  * rowToMarkdown
  *   return table row as markdown string
  *
  * @param Array $row
  * @param Array $widths
  * @return String
  */
  public function rowToMarkdown(array $row, array $widths){
    $markdown = "";
    foreach($row as $index => $cell){
      $padding = $widths[$index] - mb_strlen($cell, "UTF-8");
      $padding++;  

      $markdown .= "| ";
      $markdown .= "$cell" . str_repeat(' ', $padding);
    }

    $markdown .= "|";

    return $markdown;
  }

  /**
  * parseEntry
  *   Convert Entry element to string
  * 
  * @param SimpleXMLElement $entry
  * @return String
  */
  public function parseEntry($entry){
    $content = trim(strip_tags(preg_replace('/<superscript>([^<]+)<\/superscript>/', '^$1^', $entry->asXML())));

    return $content;
  }

  /**
  * getTableWidth
  *   return total table width
  *
  * @param Array $widths
  * @param Int $columns
  * @return Int
  */
  public function getTableWidth($widths, $columns){
    $contentWidth = array_sum($widths);
    $spacePadding = 2 * $columns;
    $dividerWidth = $columns + 1;

    $total = $contentWidth + $spacePadding + $dividerWidth;

    return $total;
  }
}
