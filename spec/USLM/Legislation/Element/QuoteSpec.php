<?php

namespace spec\USLM\Legislation\Element;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class QuoteSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('USLM\Legislation\Element\Quote');
    }

    function it_should_return_markdown(){
      $raw = '<quote>pooling and servicing agreement</quote>';

      $expected = '"pooling and servicing agreement"';

      $this->simplexml($raw);
      $this->asMarkdown()->shouldBe($expected);
    }
}
