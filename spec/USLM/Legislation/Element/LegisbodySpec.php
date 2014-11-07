<?php

namespace spec\USLM\Legislation\Element;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LegisbodySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('USLM\Legislation\Element\Legisbody');
    }

    function it_should_return_as_markdown() {
      $raw = '<legis-body id="H27D02F5FF0C64F778C236492B698CD17" style="OLC">
                <section id="H8C0DF54AD83642668CBE17DC240296F0" section-type="section-one">
                  <enum>1.</enum>
                  <header>Short title</header>
                  <text display-inline="no-display-inline">This Act may be cited as the <quote><short-title>Constitution and Citizenship Day Act of 2014</short-title></quote>.</text>
                </section>
                <section id="HB270B8DCC56145D7AE748C8806AEA316">
                  <enum>2.</enum>
                  <header>Constitution Day and civic responsibility system for students</header>
                  <text display-inline="no-display-inline">Part C of title II of the Elementary and Secondary Education Act of 1965 (<external-xref legal-doc="usc" parsable-cite="usc/20/6601">20 U.S.C. 6601 et seq.</external-xref>)
                   is amended by adding at the end the following new subpart:</text>
                  <quoted-block display-inline="no-display-inline" id="HF4557D6047F549D290493675C8C0DF2A" style="OLC">
                    <subpart id="H478D95783D454A6CB030AEAD48C3FCC9">
                      <enum>6</enum>
                      <header>Teaching of the Constitution</header>
                      <section id="H3EE1EB43FDD146B495418EC6E6232D0C">
                        <enum>2371.</enum>
                        <header>Establishment and operation of Constitution Day Grant Program</header>
                        <subsection id="HECC34EE06F0845F1A4DE299CAA0EC3B0">
                          <enum>(a)</enum>
                          <header>Grant program authorized</header>
                          <text display-inline="yes-display-inline">The Secretary shall establish and implement a grant program, to be known as the <quote>Constitution Day Grant Program</quote>, under which the Secretary shall award grants on a competitive basis to local educational agencies
                   and charter schools for the purposes of enhancing educational programs to
                   teach students about the United States Constitution and the constitution
                   of the State in which the grant recipient is located.</text>
                        </subsection>
                        <subsection id="H4D94F652EDAF4FA5B4FD99CD5AAB213C">
                          <enum>(b)</enum>
                          <header>Grantee eligibility requirements</header>
                          <text display-inline="yes-display-inline">Grants under this section may only be awarded to a local educational agency or charter school with
                   established secondary educational programs to teach students about the
                   United States Constitution and the constitution of the State in which the
                   grant recipient is located.</text>
                        </subsection>
                        <subsection id="H7C238CD2B2F04468A89666C9521D23B6">
                          <enum>(c)</enum>
                          <header>Operation of educational programs</header>
                          <text display-inline="yes-display-inline">An educational program funded by a grant under this section shall&#x2014;</text>
                          <paragraph id="H4C0736B0C70940EAB6788530B7A7D499">
                            <enum>(1)</enum>
                            <text display-inline="yes-display-inline">occur on Constitution Day, September 17, of each calender year (or on the Monday immediately
                   following Constitution Day, if Constitution Day falls on a Saturday or a
                   Sunday);</text>
                          </paragraph>
                          <paragraph id="H2D4EFA3A1319435CB05EC71968E2189E">
                            <enum>(2)</enum>
                            <text>include assemblies, discussions, presentations, or events commemorating the Constitution of the
                   United States and the constitution of the State in which the grant
                   recipient is located;</text>
                          </paragraph>
                          <paragraph id="H3E141BE998D541B98D6B8B3CE90AFA5F">
                            <enum>(3)</enum>
                            <text display-inline="yes-display-inline">include efforts to reinforce existing Constitutional curricula conducted by the grant recipient;
                   and</text>
                          </paragraph>
                          <paragraph id="HC3EA005BD2B347C291FF65D48150098C">
                            <enum>(4)</enum>
                            <text display-inline="yes-display-inline">make available to eligible students participating in such program the ability to register to vote.</text>
                          </paragraph>
                        </subsection>
                        <subsection id="H057AF4FCD3A04A3D97B970D9CD80A8C9">
                          <enum>(d)</enum>
                          <header>Voter registration laws</header>
                          <text display-inline="yes-display-inline">A grant recipient under this section shall abide by all applicable State and Federal voter
                   registration laws.</text>
                        </subsection>
                      </section>
                      <section id="H431073589F814A0C8719C5801F670D34">
                        <enum>2372.</enum>
                        <header>Grant application process</header>
                        <subsection id="H2184D5811DC14691B269C7A2414C8086">
                          <enum>(a)</enum>
                          <header>Secretary created process</header>
                          <text display-inline="yes-display-inline">The Secretary shall develop an application process for the grant program under this subpart,
                   consistent with the requirements of this section.</text>
                        </subsection>
                        <subsection id="H0CC17963ED354130A3380A01567490AD">
                          <enum>(b)</enum>
                          <header>Grant application requirements</header>
                          <text display-inline="yes-display-inline">An application for a grant under this subpart shall&#x2014;</text>
                          <paragraph id="HFC41A0D824144D2E93933A60D123B9C3">
                            <enum>(1)</enum>
                            <text display-inline="yes-display-inline">describe the educational activities to be funded by the grant; and</text>
                          </paragraph>
                          <paragraph id="H69BBC1558FAB487E86BDD93FF56F7035">
                            <enum>(2)</enum>
                            <text display-inline="yes-display-inline">provide assurances that the requirements of section 2371(c) will be met, and any additional
                   assurances that the Secretary determines to be necessary to ensure
                   compliance with the requirements of this subpart.</text>
                          </paragraph>
                        </subsection>
                      </section>
                      <section id="H0305C622B56B426584996332B8C72F78">
                        <enum>2373.</enum>
                        <header>Authorization of appropriations</header>
                        <text display-inline="no-display-inline">There is authorized to be appropriated to the Secretary $4,000,000 for each of fiscal years 2015
                   through 2019 to carry out this subpart.</text>
                      </section>
                    </subpart>
                    <after-quoted-block>.</after-quoted-block>
                  </quoted-block>
                </section>
              </legis-body>';

      $expected = "";
      $expected .= "* __1. Short title__\n";
      $expected .= "  * This Act may be cited as the \"Constitution and Citizenship Day Act of 2014\".\n";
      $expected .= "* __2. Constitution Day and civic responsibility system for students__\n";
      $expected .= "  * Part C of title II of the Elementary and Secondary Education Act of 1965 (20 U.S.C. 6601 et seq.) is amended by adding at the end the following new subpart:\n";
      $expected .= "  > 6 Teaching of the Constitution\n";
      $expected .= "  > 2371. Establishment and operation of Constitution Day Grant Program\n";
      $expected .= "  >   (a) Grant program authorized\n";
      $expected .= "  >     The Secretary shall establish and implement a grant program, to be known as the \"Constitution Day Grant Program\", under which the Secretary shall award grants on a competitive basis to local educational agencies and charter schools for the purposes of enhancing educational programs to teach students about the United States Constitution and the constitution of the State in which the grant recipient is located.\n";
      $expected .= "  >   (b) Grantee eligibility requirements\n";
      $expected .= "  >     Grants under this section may only be awarded to a local educational agency or charter school with established secondary educational programs to teach students about the United States Constitution and the constitution of the State in which the grant recipient is located.\n";
      $expected .= "  >   (c) Operation of educational programs\n";
      $expected .= "  >     An educational program funded by a grant under this section shall—\n";
      $expected .= "  >     (1) occur on Constitution Day, September 17, of each calender year (or on the Monday immediately following Constitution Day, if Constitution Day falls on a Saturday or a Sunday);\n";
      $expected .= "  >     (2) include assemblies, discussions, presentations, or events commemorating the Constitution of the United States and the constitution of the State in which the grant recipient is located;\n";
      $expected .= "  >     (3) include efforts to reinforce existing Constitutional curricula conducted by the grant recipient; and\n";
      $expected .= "  >     (4) make available to eligible students participating in such program the ability to register to vote.\n";
      $expected .= "  >   (d) Voter registration laws\n";
      $expected .= "  >     A grant recipient under this section shall abide by all applicable State and Federal voter registration laws.\n";
      $expected .= "  > 2372. Grant application process\n";
      $expected .= "  >   (a) Secretary created process\n";
      $expected .= "  >     The Secretary shall develop an application process for the grant program under this subpart, consistent with the requirements of this section.\n";
      $expected .= "  >   (b) Grant application requirements\n";
      $expected .= "  >     An application for a grant under this subpart shall—\n";
      $expected .= "  >     (1) describe the educational activities to be funded by the grant; and\n";
      $expected .= "  >     (2) provide assurances that the requirements of section 2371(c) will be met, and any additional assurances that the Secretary determines to be necessary to ensure compliance with the requirements of this subpart.\n";
      $expected .= "  > 2373. Authorization of appropriations\n";
      $expected .= "  >   There is authorized to be appropriated to the Secretary $4,000,000 for each of fiscal years 2015 through 2019 to carry out this subpart.\n";
      $expected .= "  .";

      $this->simplexml($raw);
      $this->asMarkdown()->shouldBe($expected);
    }
}
