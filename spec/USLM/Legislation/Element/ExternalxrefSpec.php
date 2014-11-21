<?php

namespace spec\USLM\Legislation\Element;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExternalxrefSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('USLM\Legislation\Element\Externalxref');
    }

    function it_should_return_markdown(){
      $raw = '<external-xref legal-doc="usc" parsable-cite="usc/12/1715n">12 U.S.C. 1715n</external-xref>';

      $expected = "*12 U.S.C. 1715n*";

      $this->simplexml($raw);
      $this->asMarkdown()->shouldBe($expected);
    }
}
