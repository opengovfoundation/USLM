<?php

namespace spec\USLM\Legislation\Element\LegisBody;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('USLM\Legislation\Element\LegisBody\Section');
    }

    function it_should_return_as_markdown_minimal() {
      $raw = '<section id="H30877CE3A2D242CF8171B9732FD38A78" section-type="section-one">
                <enum>1.</enum>
                <header>Short title</header>
                <text display-inline="no-display-inline">This Act may be cited as the <quote><short-title>Success and Opportunity through Quality Charter Schools Act</short-title></quote>.</text>
              </section>';

      $expected = "* __1. Short title__\n  * This Act may be cited as the \"Success and Opportunity through Quality Charter Schools Act\".";

      $simplexml = simplexml_load_string($raw);
      $this->simplexml($simplexml);
      $this->asMarkdown()->shouldBe($expected);
    }

    function it_should_return_as_markdown_with_quoted_block() {
      $raw = '<section id="H1B0FA4A563064F828341518409B00F73">
                <enum>10.</enum>
                <header>Authorization of appropriations</header>
                <text display-inline="no-display-inline">Section 5211 (<external-xref legal-doc="usc" parsable-cite="usc/20/7221j">20 U.S.C. 7221j</external-xref>) is amended to read as follows:</text>
                <quoted-block display-inline="no-display-inline" id="H8535149437C447C7BF1F81700BAAEEA5" style="OLC">
                  <section id="H10D0419BBA8441EA923C1A07FD09FA34">
                    <enum>5211.</enum>
                    <header>Authorization of appropriations</header>
                    <text display-inline="no-display-inline">There are authorized to be appropriated to carry out this subpart $300,000,000 for fiscal year 2015 and each of the 5 succeeding fiscal years.</text>
                  </section>
                  <after-quoted-block>.</after-quoted-block>
                </quoted-block>
              </section>';

      $expected = "* __10. Authorization of appropriations__\n";
      $expected .= "  * Section 5211 (20 U.S.C. 7221j) is amended to read as follows:\n";
      $expected .= "***\n";
      $expected .= "5211.\n";
      $expected .= "Authorization of appropriations\n";
      $expected .= "There are authorized to be appropriated to carry out this subpart $300,000,000 for fiscal year 2015 and each of the 5 succeeding fiscal years.\n";
      $expected .= "***\n";
      $expected .= ".\n";


    }
}
