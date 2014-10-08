<?php

namespace spec\USLM\Legislation\Element\Action;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SponsorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('USLM\Legislation\Element\Action\Sponsor');
    }

    function it_returns_the_correct_string(){
      $raw = '<sponsor name-id="L000564">Mr. Lamborn</sponsor>';

      $simplexml = simplexml_load_string($raw);

      $this->simplexml($simplexml);

      $this->__toString()->shouldBe('Mr. Lamborn');
    }
}
