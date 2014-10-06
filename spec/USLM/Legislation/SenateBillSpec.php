<?php

namespace spec\USLM\Legislation;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SenateBillSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
      $this->shouldHaveType('USLM\Legislation\SenateBill');
    }
}
