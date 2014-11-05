<?php

namespace spec\USLM\Legislation\Element;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LegisBodyElementTestSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('USLM\Legislation\Element\LegisBodyElementTest');
    }

    function it_should_indent_lists() {
      $markdown = "";
      $markdown .= "* __1. Counseling and treatment for sexual trauma occurring during inactive duty for training__\n";
      $markdown .= "  * Section 1720D of title 38, United States Code, is amended—\n";
      $markdown .= "  * __(1)__ in subsection (a)(1), by striking \"active duty or active duty for training\" and inserting \"active duty, active duty for training, or inactive duty training\"; and\n";
      $markdown .= "  * __(2)__ in subsection (f)—\n";
      $markdown .= "    * __(A)__ by striking \"this section, the\" and inserting the following:\n";
      

      $expected = "";
      $expected .= "  * __1. Counseling and treatment for sexual trauma occurring during inactive duty for training__\n";
      $expected .= "    * Section 1720D of title 38, United States Code, is amended—\n";
      $expected .= "    * __(1)__ in subsection (a)(1), by striking \"active duty or active duty for training\" and inserting \"active duty, active duty for training, or inactive duty training\"; and\n";
      $expected .= "    * __(2)__ in subsection (f)—\n";
      $expected .= "      * __(A)__ by striking \"this section, the\" and inserting the following:\n";

      $this->indentList($markdown, 2)->shouldBe($expected);      

      //Test again to test against matching the ^ character
      $expected2 = "";
      $expected2 .= "    * __1. Counseling and treatment for sexual trauma occurring during inactive duty for training__\n";
      $expected2 .= "      * Section 1720D of title 38, United States Code, is amended—\n";
      $expected2 .= "      * __(1)__ in subsection (a)(1), by striking \"active duty or active duty for training\" and inserting \"active duty, active duty for training, or inactive duty training\"; and\n";
      $expected2 .= "      * __(2)__ in subsection (f)—\n";
      $expected2 .= "        * __(A)__ by striking \"this section, the\" and inserting the following:\n";

      $this->indentList($expected, 2)->shouldBe($expected2); 
    }

    function it_should_indent_quoted_blocks() {
      $markdown = "";
      $markdown .= "* __(B)__ by adding at the end the following new paragraph:\n";
      $markdown .= "> (2) The term \"veteran\", with respect to inactive duty training described in subsection (a)(1), also includes an individual who—\n";
      $markdown .= ">   (A) is not otherwise eligible for the benefits of this chapter; and\n";
      $markdown .= ">   (B) while serving in the reserve components of the Armed Forces, performed such inactive duty training but did not serve on active duty.\n";

      $expected = "";
      $expected .= "* __(B)__ by adding at the end the following new paragraph:\n";
      $expected .= "  > (2) The term \"veteran\", with respect to inactive duty training described in subsection (a)(1), also includes an individual who—\n";
      $expected .= "  >   (A) is not otherwise eligible for the benefits of this chapter; and\n";
      $expected .= "  >   (B) while serving in the reserve components of the Armed Forces, performed such inactive duty training but did not serve on active duty.\n";

      $this->indentQuotedBlock($markdown, 2)->shouldBe($expected);

      //Test again to test against matching the ^ character
      $expected2 = "";
      $expected2 .= "* __(B)__ by adding at the end the following new paragraph:\n";
      $expected2 .= "    > (2) The term \"veteran\", with respect to inactive duty training described in subsection (a)(1), also includes an individual who—\n";
      $expected2 .= "    >   (A) is not otherwise eligible for the benefits of this chapter; and\n";
      $expected2 .= "    >   (B) while serving in the reserve components of the Armed Forces, performed such inactive duty training but did not serve on active duty.\n";

      $this->indentQuotedBlock($expected, 2)->shouldBe($expected2);
    }
}
