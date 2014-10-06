<?php
/**
* Abstract Legislation Attribute Class
*/
namespace USLM\Legislation\Attribute;

abstract class Attribute{

  function __construct() {
    if (!defined('static::TYPE_CODE') || !defined('static::TYPE_NAME')){
      throw new TypeNotFoundException('Constant (TYPE_CODE || TYPE_NAME) not defined on subclass ' . get_class($this));
    }
  }
}