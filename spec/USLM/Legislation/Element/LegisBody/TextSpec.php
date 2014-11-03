<?php

namespace spec\USLM\Legislation\Element\LegisBody;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TextSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('USLM\Legislation\Element\LegisBody\Text');
    }

    function it_should_output_markdown_with_term_children_and_html_entities() {
      $raw = '<text display-inline="yes-display-inline">The term <term>bicycle sharing system</term> means a public transportation system&#x2014;</text>';

      $expected = 'The term "bicycle sharing system" means a public transportation system—';

      $simplexml = simplexml_load_string($raw);
      $this->simplexml($simplexml);
      $this->asMarkdown()->shouldBe($expected);
    }

    function it_should_handle_newlines_correctly() {
      $raw = '<text>consisting of a network of stations at which bicycles are made available to customers for commuting
       and short-term, point-to-point use within the network&#x2019;s service area; and</text>';

      $expected = "consisting of a network of stations at which bicycles are made available to customers for commuting and short-term, point-to-point use within the network’s service area; and";

      $simplexml = simplexml_load_string($raw);
      $this->simplexml($simplexml);
      $this->asMarkdown()->shouldBe($expected);
    }
}
