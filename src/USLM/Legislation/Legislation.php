<?php
/**
* Abstract Legislation Class
*/
namespace USLM\Legislation;
use USLM\Element;

abstract class Legislation extends Element{

  function __construct() {
    if (!defined('static::TYPE_NAME') || !defined('static::TYPE_CODE')){
      throw new TypeNotFoundException('Constant (TYPE_NAME || TYPE_CODE) not defined on subclass ' . get_class($this));
    }
  }
}