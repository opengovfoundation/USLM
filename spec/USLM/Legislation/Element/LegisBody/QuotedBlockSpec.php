<?php

namespace spec\USLM\Legislation\Element\LegisBody;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class QuotedBlockSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('USLM\Legislation\Element\LegisBody\QuotedBlock');
    }

    function it_should_return_as_markdown() {
      $raw = '<quoted-block display-inline="no-display-inline" id="H8535149437C447C7BF1F81700BAAEEA5" style="OLC">
                  <section id="H10D0419BBA8441EA923C1A07FD09FA34">
                    <enum>5211.</enum>
                    <header>Authorization of appropriations</header>
                    <text display-inline="no-display-inline">There are authorized to be appropriated to carry out this subpart $300,000,000 for fiscal year 2015 and each of the 5 succeeding fiscal years.</text>
                  </section>
                  <after-quoted-block>.</after-quoted-block>
                </quoted-block>';

      $expected = "";
      $expected .= "***\n";
      $expected .= "5211.\n";
      $expected .= "Authorization of appropriations\n";
      $expected .= "There are authorized to be appropriated to carry out this subpart $300,000,000 for fiscal year 2015 and each of the 5 succeeding fiscal years.\n";
      $expected .= "***\n";
      $expected .= ".";

      $simplexml = simplexml_load_string($raw);

      $this->simplexml($simplexml);

      $this->asMarkdown()->shouldBe($expected);
    }
}
