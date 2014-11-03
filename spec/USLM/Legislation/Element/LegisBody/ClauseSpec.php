<?php

namespace spec\USLM\Legislation\Element\LegisBody;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClauseSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('USLM\Legislation\Element\LegisBody\Clause');
    }

    function it_should_output_as_markdown_with_subclause() {
      $raw = '<clause id="H88CC415A498D45B1B7DED2365D2CFFDF">
                <enum>(ii)</enum>
                <header>Bicycle Sharing System</header>
                <text display-inline="yes-display-inline">The term <term>bicycle sharing system</term> means a public transportation system&#x2014;</text>
                <subclause id="H6B1486CD193D4B95B8740EDF9A7ED0EC">
                  <enum>(I)</enum>
                  <text>consisting of a network of stations at which bicycles are made available to customers for commuting
         and short-term, point-to-point use within the network&#x2019;s service area; and</text>
                </subclause>
                <subclause id="HBAA1903CFBD3435A9BECC1EEEDCB7FAF">
                  <enum>(II)</enum>
                  <text>that is operated or authorized by a government agency or public-private partnership.</text>
                </subclause>
              </clause>';

      $expected = "";
      $expected .= "* __(ii) Bicycle Sharing System__\n";
      $expected .= "  * The term \"bicycle sharing system\" means a public transportation system—\n";
      $expected .= "    * __(I)__ consisting of a network of stations at which bicycles are made available to customers for commuting and short-term, point-to-point use within the network’s service area; and\n";
      $expected .= "    * __(II)__ that is operated or authorized by a government agency or public-private partnership.";

      $simplexml = simplexml_load_string($raw);
      $this->simplexml($simplexml);
      $this->asMarkdown()->shouldBe($expected);
    }
}
