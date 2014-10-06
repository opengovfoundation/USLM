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

    function its_constants_are_defined(){
      SenateBill::TYPE_NAME->shouldBe('Senate Bill');
    }
}
