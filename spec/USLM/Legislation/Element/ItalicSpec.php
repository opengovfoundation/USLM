<?php

namespace spec\USLM\Legislation\Element;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ItalicSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('USLM\Legislation\Element\Italic');
    }

    function it_should_return_markdown(){
      $raw = '<italic>Provided</italic>';
      $expected = '*Provided*';

      $this->simplexml($raw);
      $this->asMarkdown()->shouldBe($expected);
    }
}
