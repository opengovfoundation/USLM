<?php

namespace spec\USLM\Legislation\Element;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('USLM\Legislation\Element\Section');
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

    function it_should_return_as_markdown_with_appropriations() {
      $raw = '<section id="H27C9DD73600F4DF2BA9822D804630D01">
                <enum>2.</enum>
                <header>Supplemental appropriation for the Office of the Inspector General of the Department of Veterans Affairs</header>
                <text display-inline="no-display-inline">The following sums are appropriated, out of any money in the Treasury not otherwise appropriated, for fiscal year 2014:</text>
                <appropriations-major id="HCB081D82343246198C49FEA7326065B4">
                  <header>Department of Veterans Affairs</header>
                </appropriations-major>
                <appropriations-intermediate id="H2E4D865EC53B44A8B08737BE69C56873">
                  <header>Departmental Administration</header>
                </appropriations-intermediate>
                <appropriations-small id="HDCAFF61B0EE84EF98FD9B0D99E55D172">
                  <header>Office of Inspector General</header>
                </appropriations-small>
              </section>';

      $expected = "";
      $expected .= "* __2. Supplemental appropriation for the Office of the Inspector General of the Department of Veterans Affairs__\n";
      $expected .= "  * The following sums are appropriated, out of any money in the Treasury not otherwise appropriated, for fiscal year 2014:\n";
      $expected .= "#### Department of Veterans Affairs\n";
      $expected .= "##### Departmental Administration\n";
      $expected .= "###### Office of Inspector General";

      $simplexml = simplexml_load_string($raw);
      $this->simplexml($simplexml);
      $this->asMarkdown()->shouldBe($expected);
    }

    function it_should_return_as_markdown_with_subparagraphs() {
      $raw = '<section id="H7EB1EEA8B2ED49FC9C2E5FE2B5017D65" section-type="section-one">
                <enum>1.</enum>
                <header>Counseling and treatment for sexual trauma occurring during inactive duty for training</header>
                <text display-inline="no-display-inline"><external-xref legal-doc="usc" parsable-cite="usc/38/1720D">Section 1720D</external-xref> of title 38, United States Code, is amended&#x2014;</text>
                <paragraph id="H2DC2A70DBE734139992BD15A07083179">
                  <enum>(1)</enum>
                  <text display-inline="yes-display-inline">in subsection (a)(1), by striking <quote>active duty or active duty for training</quote> and inserting <quote>active duty, active duty for training, or inactive duty training</quote>; and</text>
                </paragraph>
                <paragraph id="H2A45A1C4C9E44CA1A52E2B41C65E04EA">
                  <enum>(2)</enum>
                  <text>in subsection (f)&#x2014;</text>
                  <subparagraph id="H9CFE93E8F0984B1099DE6E2E4BD24894">
                    <enum>(A)</enum>
                    <text>by striking <quote>this section, the</quote> and inserting the following:</text>
                    <quoted-block display-inline="yes-display-inline" id="HB0FB2BF353304463A80EC63111E3CC50" style="USC">
                      <text>this section:</text>
                      <paragraph id="HBE3478C1C6FC42BEB7A973848F65F973" indent="up1">
                        <enum>(1)</enum>
                        <text display-inline="yes-display-inline">The</text>
                      </paragraph>
                      <after-quoted-block>; and</after-quoted-block>
                    </quoted-block>
                  </subparagraph>
                  <subparagraph id="H9DF57B6899BC44198465A5B3DC7AF93C">
                    <enum>(B)</enum>
                    <text>by adding at the end the following new paragraph:</text>
                    <quoted-block display-inline="no-display-inline" id="HB7630BED0A2F4E9493C2B1BB28E55298" style="USC">
                      <paragraph id="H16A12E2BE00649A788D1AD6A692E6A2D" indent="up1">
                        <enum>(2)</enum>
                        <text display-inline="yes-display-inline">The term <quote>veteran</quote>, with respect to inactive duty training described in subsection (a)(1), also includes an individual who&#x2014;</text>
                        <subparagraph id="H4572607307C24A648CF0E2F348437C17">
                          <enum>(A)</enum>
                          <text>is not otherwise eligible for the benefits of this chapter; and</text>
                        </subparagraph>
                        <subparagraph id="H80B28A06C0F64534ADC6A756871BE0E6">
                          <enum>(B)</enum>
                          <text>while serving in the reserve components of the Armed Forces, performed such inactive duty training but did not serve on active duty.</text>
                        </subparagraph>
                      </paragraph>
                      <after-quoted-block>.</after-quoted-block>
                    </quoted-block>
                  </subparagraph>
                </paragraph>
              </section>';

      $expected = "";
      $expected .= "* __1. Counseling and treatment for sexual trauma occurring during inactive duty for training__\n";
      $expected .= "  * Section 1720D of title 38, United States Code, is amended—\n";
      $expected .= "  * __(1)__ in subsection (a)(1), by striking \"active duty or active duty for training\" and inserting \"active duty, active duty for training, or inactive duty training\"; and\n";
      $expected .= "  * __(2)__ in subsection (f)—\n";
      $expected .= "    * __(A)__ by striking \"this section, the\" and inserting the following:\n";
      $expected .= "      \n";
      $expected .= "      > this section:\n";
      $expected .= "      > (1) The\n";
      $expected .= "      ; and\n";
      $expected .= "    * __(B)__ by adding at the end the following new paragraph:\n";
      $expected .= "      \n";
      $expected .= "      > (2) The term \"veteran\", with respect to inactive duty training described in subsection (a)(1), also includes an individual who—\n";
      $expected .= "      >   (A) is not otherwise eligible for the benefits of this chapter; and\n"; 
      $expected .= "      >   (B) while serving in the reserve components of the Armed Forces, performed such inactive duty training but did not serve on active duty.\n";
      $expected .= "      .";

      $simplexml = simplexml_load_string($raw);
      $this->simplexml($simplexml);
      $this->asMarkdown()->shouldBe($expected);
    }
}
