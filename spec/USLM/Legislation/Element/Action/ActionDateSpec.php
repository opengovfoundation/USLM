<?php

namespace spec\USLM\Legislation\Element\Action;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ActionDateSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('USLM\Legislation\Element\Action\ActionDate');
    }

    function it_returns_the_correct_date(){
      $raw = '<action-date date="20130312">March 12, 2013</action-date>';

      $simplexml = simplexml_load_string($raw);
      $this->simplexml($simplexml);

      $this->__toString()->shouldBe('March 12, 2013');
    }
}
