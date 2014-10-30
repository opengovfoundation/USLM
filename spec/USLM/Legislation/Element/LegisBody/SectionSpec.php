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

      $simplexml = simplexml_load_string($raw);
      $this->simplexml($simplexml);
      $this->asMarkdown()->shouldBeString();
    }

    function it_should_return_as_markdown_with_toc() {
      $raw = '<section id="H933B1849AA854E5B8B7BD5AC06BEB6DB">
                <enum>2.</enum>
                <header>Table of contents</header>
                <text display-inline="no-display-inline">The table of contents for this Act is as follows:</text>
                <toc container-level="legis-body-container" lowest-bolded-level="division-lowest-bolded" lowest-level="section" quoted-block="no-quoted-block" regeneration="yes-regeneration">
                  <toc-entry idref="HD70AD3C5193543CF80F19C9D4AA03A65" level="section">Sec.&#x2002;1.&#x2002;Short title.</toc-entry>
                  <toc-entry idref="H933B1849AA854E5B8B7BD5AC06BEB6DB" level="section">Sec.&#x2002;2.&#x2002;Table of contents.</toc-entry>
                  <toc-entry idref="H933B1849AA854E5B8B7BD5AC06BEB6DB" level="section">Sec. 3.&#x2002;PAYGO scorecard.</toc-entry>
                  <toc-entry idref="H58A6E2C173F54851BCDC7D43B4962A6E" level="division">Division I&#x2014;Ways and Means</toc-entry>
                  <toc-entry idref="H43B414A66CD64D49BB8E22DF979E3951" level="title">Title I&#x2014;Save American Workers </toc-entry>
                  <toc-entry idref="HDA20684EA97C473B8891030F3BDE534D" level="section">Sec.&#x2002;101.&#x2002;Short title.</toc-entry>
                  <toc-entry idref="HF6F72FEC916442F0A745C86C6E6545D4" level="section">Sec.&#x2002;102.&#x2002;Repeal of 30-hour threshold for classification as full-time employee for purposes of the
                 employer mandate in the Patient Protection and Affordable Care Act and
                 replacement with 40 hours.</toc-entry>
                  <toc-entry idref="HD6B4A8772AD748FABA847DEA1D73CAA2" level="title">Title II&#x2014;Hire More Heroes </toc-entry>
                  <toc-entry idref="HC4E8CBCB8B5C4954A137734AC0596841" level="section">Sec.&#x2002;201.&#x2002;Short title.</toc-entry>
                </toc>
              </section>';

      $simplexml = simplexml_load_string($raw);
      $this->simplexml($simplexml);
      $this->asMarkdown()->shouldBeString();
    }
}
