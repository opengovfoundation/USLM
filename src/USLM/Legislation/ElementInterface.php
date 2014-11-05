<?php

namespace USLM\Legislation;

interface ElementInterface{
  public function getType();
  public function getHeader();
  public function getText();
  public function getChildren();
}