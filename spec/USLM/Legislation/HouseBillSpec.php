<?php

namespace spec\USLM\Legislation;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HouseBillSpec extends ObjectBehavior
{

  function it_is_initializable()
  {
      $this->shouldHaveType('USLM\Legislation\HouseBill');
  }

  function it_should_load_the_xml() {
    $raw = file_get_contents(__DIR__ . '/../../data/valid1.xml');

    $this->loadXML($raw)->shouldReturn(true);
  }

  function it_should_get_the_body(){
    $raw = file_get_contents(__DIR__ . '/../../data/valid1.xml');

    $this->loadXML($raw);
    $this->getBody()->shouldReturnAnInstanceOf('SimpleXMLElement');
  }

  function it_should_get_the_form(){
    $raw = file_get_contents(__DIR__ . '/../../data/valid1.xml');

    $this->loadXML($raw);
    $this->getForm()->shouldReturnAnInstanceOf('SimpleXMLElement');
  }

  function it_should_get_the_bill_stage(){
    $raw = file_get_contents(__DIR__ . '/../../data/valid1.xml');

    $this->loadXML($raw);
    $stage = $this->getBillStage()->shouldBeEqualTo('Engrossed-in-House');
  }
}
