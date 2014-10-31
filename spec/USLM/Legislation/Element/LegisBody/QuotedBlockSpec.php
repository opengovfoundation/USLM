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
      $expected .= "5211. Authorization of appropriations\n";
      $expected .= "There are authorized to be appropriated to carry out this subpart $300,000,000 for fiscal year 2015 and each of the 5 succeeding fiscal years.\n";
      $expected .= "***\n";
      $expected .= ".";

      $simplexml = simplexml_load_string($raw);

      $this->simplexml($simplexml);

      $this->asMarkdown()->shouldBe($expected);
    }

    function it_should_handle_subsection_children() {
      $raw = '<quoted-block style="OLC" id="H1B2EC132803F480F8841EEBBF9E46280" display-inline="no-display-inline">
                <subsection id="H311CAB4BF827411384F96403E73208A3">
                  <enum>(g)</enum>
                  <header>Public Disclosure of LNG Export Destinations</header>
                  <text display-inline="yes-display-inline">As a condition for approval of any authorization to export LNG, the Secretary of Energy shall require the applicant to publicly disclose the specific destination or destinations of any such authorized LNG exports.</text>
                </subsection>
                <after-quoted-block>.</after-quoted-block>
              </quoted-block>';

      $expected = "";
      $expected .= "***\n";
      $expected .= "(g) Public Disclosure of LNG Export Destinations\n";
      $expected .= "As a condition for approval of any authorization to export LNG, the Secretary of Energy shall require the applicant to publicly disclose the specific destination or destinations of any such authorized LNG exports.\n";
      $expected .= "***\n";
      $expected .= ".";

      $simplexml = simplexml_load_string($raw);
      $this->simplexml($simplexml);
      $this->asMarkdown()->shouldBe($expected);
    }

    function it_should_handle_subparagraph_children() {
      $raw = '<quoted-block style="OLC" id="HB5E322CB6DFA412FA4A9073070764E02" display-inline="no-display-inline">
                <subparagraph id="HCB3F0A02C8984ABAB30F431D6EA8BC1E">
                  <enum>(D)</enum>
                  <text display-inline="yes-display-inline">that is under the jurisdiction of the Secretary of Defense or the Secretary of a military department;</text>
                </subparagraph>
                <after-quoted-block>.</after-quoted-block>
              </quoted-block>';

      $expected = "";
      $expected .= "***\n";
      $expected .= "(D) that is under the jurisdiction of the Secretary of Defense or the Secretary of a military department;\n";
      $expected .= "***\n";
      $expected .= ".";

      $simplexml = simplexml_load_string($raw);
      $this->simplexml($simplexml);
      $this->asMarkdown()->shouldBe($expected);
    }

    function it_should_handle_clause_children() {
      $raw = '<quoted-block display-inline="no-display-inline" id="H874EE187D639471DBED781E6030AD5C2" style="OLC">
                <clause id="HCFBA055CCC1F41E79A644817CEB7C87F">
                  <enum>(ii)</enum>
                  <text display-inline="yes-display-inline">any purchase or sale of a nonfinancial commodity or security for deferred shipment or delivery, so
               long as the transaction is intended to be physically settled, including
               any stand-alone or embedded option for which exercise results in a
               physical delivery obligation;</text>
                </clause>
                <after-quoted-block>.</after-quoted-block>
              </quoted-block>';

      $expected = "";
      $expected .= "***\n";
      $expected .= "(ii) any purchase or sale of a nonfinancial commodity or security for deferred shipment or delivery, so\n";
      $expected .= "long as the transaction is intended to be physically settled, including\n";
      $expected .= "any stand-alone or embedded option for which exercise results in a\n";
      $expected .= "physical delivery obligation;\n";
      $expected .= "***\n";
      $expected .= ".";

      $simplexml = simplexml_load_string($raw);
      $this->simplexml($simplexml);
      $this->asMarkdown()->shouldBe($expected);
    } 
}
