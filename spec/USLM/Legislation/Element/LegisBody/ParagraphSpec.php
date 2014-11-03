<?php

namespace spec\USLM\Legislation\Element\LegisBody;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ParagraphSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('USLM\Legislation\Element\LegisBody\Paragraph');
    }

    function it_should_return_markdown() {
      $raw = $this->getRaw();
      $simplexml = simplexml_load_string($raw);
      $this->simplexml($simplexml);

      $expected = $this->getExpected();

      $this->asMarkdown()->shouldBe($expected);
    }

    public function getExpected() {
      $expected = "";
      $expected .= "* __(1)__ by amending paragraph (1) to read as follows:\n";
      $expected .= "***\n";
      $expected .= "(1) Charter school\n";
      $expected .= "  The term \"charter school\" means a public school that—\n";
      $expected .= "  (A) in accordance with a specific State statute authorizing the granting of charters to schools, is exempt from significant State or local rules that inhibit the flexible operation and management of public schools, but not from any rules relating to the other requirements of this paragraph;\n";
      $expected .= "  (B) is created by a developer as a public school, or is adapted by a developer from an existing public school, and is operated under public supervision and direction;\n";
      $expected .= "  (C) operates in pursuit of a specific set of educational objectives determined by the school’s developer and agreed to by the authorized public chartering agency;\n";
      $expected .= "  (D) provides a program of elementary or secondary education, or both;\n";
      $expected .= "  (E) is nonsectarian in its programs, admissions policies, employment practices, and all other operations, and is not affiliated with a sectarian school or religious institution;\n";
      $expected .= "  (F) does not charge tuition;\n";
      $expected .= "  (G) complies with the Age Discrimination Act of 1975, title VI of the Civil Rights Act of 1964, title IX of the Education Amendments of 1972, section 504 of the Rehabilitation Act of 1973, part B of the Individuals with Disabilities Education Act, the Americans with Disabilities Act of 1990 (42 U.S.C. 12101 et seq.), and section 444 of the General Education Provisions Act (20 U.S.C. 1232(g)) (commonly known as the \"Family Education Rights and Privacy Act of 1974\");\n";
      $expected .= "  (H) is a school to which parents choose to send their children, and admits students on the basis of a lottery if more students apply for admission than can be accommodated, except that in cases in which students who are enrolled in a charter school affiliated (such as by sharing a network) with another charter school, those students may be automatically enrolled in the next grade level at such other charter school, so long as a lottery is used to fill seats created through regular attrition in student enrollment;\n";
      $expected .= "  (I) agrees to comply with the same Federal and State audit requirements as do other elementary schools and secondary schools in the State, unless such State audit requirements are waived by the State;\n";
      $expected .= "  (J) meets all applicable Federal, State, and local health and safety requirements;\n";
      $expected .= "  (K) operates in accordance with State law;\n";
      $expected .= "  (L) has a written performance contract with the authorized public chartering agency in the State that includes a description of how student performance will be measured in charter schools pursuant to State assessments that are required of other schools and pursuant to any other assessments mutually agreeable to the authorized public chartering agency and the charter school; and\n";
      $expected .= "  (M) may serve prekindergarten or postsecondary students.\n";
      $expected .= "***\n";
      $expected .= ";";

      return $expected;
    }

    public function getRaw() {
      return '<paragraph id="HDA396BB0F15A4CA18812E7066AAB56C5">
                <enum>(1)</enum>
                <text>by amending paragraph (1) to read as follows:</text>
                <quoted-block display-inline="no-display-inline" id="HFF14E2625A574154AE54F8B6C1277C5C" style="OLC">
                  <paragraph id="H9F4F2D2B7096435CB66A7093EE1A7CFD">
                    <enum>(1)</enum>
                    <header>Charter school</header>
                    <text display-inline="yes-display-inline">The term <term>charter school</term> means a public school that&#x2014;</text>
                    <subparagraph id="HC44C2407C1A4495486F241B8B5292F8B">
                      <enum>(A)</enum>
                      <text display-inline="yes-display-inline">in accordance with a specific State statute authorizing the granting of charters to schools, is exempt from significant State or local rules that inhibit the flexible operation and management of public schools, but not from any rules relating to the other requirements of this paragraph;</text>
                    </subparagraph>
                    <subparagraph id="H94B95E6E7E34494F879B86A31F746776">
                      <enum>(B)</enum>
                      <text display-inline="yes-display-inline">is created by a developer as a public school, or is adapted by a developer from an existing public school, and is operated under public supervision and direction;</text>
                    </subparagraph>
                    <subparagraph id="HEF0B526158474C079D6DB81932DB1509">
                      <enum>(C)</enum>
                      <text display-inline="yes-display-inline">operates in pursuit of a specific set of educational objectives determined by the school&#x2019;s developer and agreed to by the authorized public chartering agency;</text>
                    </subparagraph>
                    <subparagraph id="H622E38AA62A345169A181CCD518AA2BD">
                      <enum>(D)</enum>
                      <text display-inline="yes-display-inline">provides a program of elementary or secondary education, or both;</text>
                    </subparagraph>
                    <subparagraph id="H6D47B16839534CFFA26AEB6605EA049B">
                      <enum>(E)</enum>
                      <text display-inline="yes-display-inline">is nonsectarian in its programs, admissions policies, employment practices, and all other operations, and is not affiliated with a sectarian school or religious institution;</text>
                    </subparagraph>
                    <subparagraph id="H8784543DCBE548568C3AE22AE52ECAAE">
                      <enum>(F)</enum>
                      <text display-inline="yes-display-inline">does not charge tuition;</text>
                    </subparagraph>
                    <subparagraph id="H6B104781CFFB4F8581D27331195E3246">
                      <enum>(G)</enum>
                      <text display-inline="yes-display-inline">complies with the Age Discrimination Act of 1975, title VI of the Civil Rights Act of 1964, title IX of the Education Amendments of 1972, section 504 of the Rehabilitation Act of 1973, part B of the Individuals with Disabilities Education Act, the Americans with Disabilities Act of 1990 (<external-xref legal-doc="usc" parsable-cite="usc/42/12101">42 U.S.C. 12101 et seq.</external-xref>), and section 444 of the General Education Provisions Act (<external-xref legal-doc="usc" parsable-cite="usc/20/1232">20 U.S.C. 1232(g)</external-xref>) (commonly known as the <quote>Family Education Rights and Privacy Act of 1974</quote>);</text>
                    </subparagraph>
                    <subparagraph id="HC82094FF90DD4C83947C698A7517FD63">
                      <enum>(H)</enum>
                      <text display-inline="yes-display-inline">is a school to which parents choose to send their children, and admits students on the basis of a lottery if more students apply for admission than can be accommodated, except that in cases in which students who are enrolled in a charter school affiliated (such as by sharing a network) with another charter school, those students may be automatically enrolled in the next grade level at such other charter school, so long as a lottery is used to fill seats created through regular attrition in student enrollment;</text>
                    </subparagraph>
                    <subparagraph id="H82CB4080E41E45C6A7D7FFB8BBABED38">
                      <enum>(I)</enum>
                      <text display-inline="yes-display-inline">agrees to comply with the same Federal and State audit requirements as do other elementary schools and secondary schools in the State, unless such State audit requirements are waived by the State;</text>
                    </subparagraph>
                    <subparagraph id="H4977FFAEC779482DBC4B892075F48E3B">
                      <enum>(J)</enum>
                      <text display-inline="yes-display-inline">meets all applicable Federal, State, and local health and safety requirements;</text>
                    </subparagraph>
                    <subparagraph id="H406BB68BF53041C2AB05BD5E1ED6232E">
                      <enum>(K)</enum>
                      <text display-inline="yes-display-inline">operates in accordance with State law;</text>
                    </subparagraph>
                    <subparagraph id="H8CA7D8102B7E4171B8A82918A2E60BC2">
                      <enum>(L)</enum>
                      <text display-inline="yes-display-inline">has a written performance contract with the authorized public chartering agency in the State that includes a description of how student performance will be measured in charter schools pursuant to State assessments that are required of other schools and pursuant to any other assessments mutually agreeable to the authorized public chartering agency and the charter school; and</text>
                    </subparagraph>
                    <subparagraph id="H03554225D78B443DB5D5AC71A57A3D5C">
                      <enum>(M)</enum>
                      <text>may serve prekindergarten or postsecondary students.</text>
                    </subparagraph>
                  </paragraph>
                  <after-quoted-block>;</after-quoted-block>
                </quoted-block>
              </paragraph>';
    }
}
