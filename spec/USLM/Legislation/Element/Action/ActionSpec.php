<?php

namespace spec\USLM\Legislation\Element\Action;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ActionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('USLM\Legislation\Element\Action\Action');
    }

    function it_should_return_the_correct_date() {
      $simplexml = $this->data1();
      $this->simplexml($simplexml);
      $this->getActionDate()->shouldBe('March 12, 2013');
    }

    function it_should_return_the_correct_desc_with_sponsor() {
      $simplexml = $this->data1();
      $this->simplexml($simplexml);

      $expected = array(
        'text'  => 'Mr. Lamborn introduced the following bill; which was referred to the Committee on Natural Resources',
        'sponsor' => array(
          'name-id' => 'L000564',
          'name' => 'Mr. Lamborn'
        ),
        'committee-name'  => 'Committee on Natural Resources'
      );

      $this->getActionDesc()->shouldBe($expected);
    }

    function it_should_return_the_correct_desc_with_cosponsors() {
      $simplexml = $this->data2();
      $this->simplexml($simplexml);

      $expected = array(
        'text'  => 'Additional sponsors: Mr. Cole, Mr. Diaz-Balart, Mr. Cramer, Mr. Coffman, Mr. Amodei, Mrs. Lummis, Mr. Stivers, Mr. Mullin, and Mr. Ross',
        'cosponsors' => array(
          array(
            'name-id' => 'C001053',
            'name'  => 'Mr. Cole'
          ),
          array(
            'name-id' => 'D000600',
            'name'  => 'Mr. Diaz-Balart'
          ),
          array(
            'name-id' => 'C001096',
            'name'  => 'Mr. Cramer'
          ),
          array(
            'name-id' => 'C001077',
            'name'  => 'Mr. Coffman'
          ),
          array(
            'name-id' => 'A000369',
            'name'  => 'Mr. Amodei'
          ),
          array(
            'name-id' => 'L000571',
            'name'  => 'Mrs. Lummis'
          ),
          array(
            'name-id' => 'S001187',
            'name'  => 'Mr. Stivers'
          ),
          array(
            'name-id' => 'M001190',
            'name'  => 'Mr. Mullin'
          ),
          array(
            'name-id' => 'R000593',
            'name'  => 'Mr. Ross'
          )
        )
      );

      $this->getActionDesc()->shouldBe($expected);
    }

    function it_should_get_the_correct_desc_with_text() {
      $this->simplexml($this->data3());
      $expected = array(
        'text'  => 'Committed to the Committee of the Whole House on the State of the Union and ordered to be printed'
      );

      $this->getActionDesc()->shouldBe($expected);
    }

    function data1() {
      $raw = '<action>
                <action-date date="20130312">March 12, 2013</action-date>
                <action-desc><sponsor name-id="L000564">Mr. Lamborn</sponsor> introduced the following bill; which was referred to the <committee-name committee-id="HII00">Committee on Natural Resources</committee-name></action-desc>
              </action>';

      $simplexml = simplexml_load_string($raw);

      return $simplexml;
    }

    function data2() {
      $raw = '<action>
                <action-date date="20140401">April 1, 2014</action-date>
                <action-desc>Additional sponsors: <cosponsor name-id="C001053">Mr. Cole</cosponsor>, <cosponsor name-id="D000600">Mr. Diaz-Balart</cosponsor>, <cosponsor name-id="C001096">Mr. Cramer</cosponsor>, <cosponsor name-id="C001077">Mr. Coffman</cosponsor>, <cosponsor name-id="A000369">Mr. Amodei</cosponsor>, <cosponsor name-id="L000571">Mrs. Lummis</cosponsor>, <cosponsor name-id="S001187">Mr. Stivers</cosponsor>, <cosponsor name-id="M001190">Mr. Mullin</cosponsor>, and <cosponsor name-id="R000593">Mr. Ross</cosponsor></action-desc>
              </action>';

      $simplexml = simplexml_load_string($raw);

      return $simplexml;
    }

    function data3() {
      $raw = '<action>
                <action-date date="20140401">April 1, 2014</action-date>
                <action-desc>Committed to the Committee of the Whole House on the State of the Union and ordered to be printed<pagebreak/></action-desc>
              </action>';

      $simplexml = simplexml_load_string($raw);

      return $simplexml;
    }
}
