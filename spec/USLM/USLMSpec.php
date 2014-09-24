<?php

namespace spec\USLM;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class USLMSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('USLM\USLM');
    }
}
