<?php

namespace spec\USLM\Legislation\Element;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InternalxrefSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('USLM\Legislation\Element\Internalxref');
    }

    function it_should_return_markdown(){
      $raw = '<internal-xref idref="HE8DE263856B34C88B7795E1760A0175A" legis-path="202.(a)(1)(A)">subparagraph (A)</internal-xref>';

      $expected = "*subparagraph (A)*";

      $this->simplexml($raw);
      $this->asMarkdown()->shouldBe($expected);
    }
}
