<?php

namespace spec\USLM\Legislation\Element\Action;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommitteeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('USLM\Legislation\Element\Action\Committee');
    }

    function it_returns_the_correct_array() {
      $raw = '<committee-name committee-id="HII00">Committee on Natural Resources</committee-name>';

      $simplexml = simplexml_load_string($raw);

      $this->simplexml($simplexml);

      $expected = array(
        'committee-id'    => 'HII00',
        'committee-name'  => 'Committee on Natural Resources'
      );

      $this->toArray()->shouldBe($expected);
    }
}
