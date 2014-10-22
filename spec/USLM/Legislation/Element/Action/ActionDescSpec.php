<?php

namespace spec\USLM\Legislation\Element\Action;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ActionDescSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
      $this->shouldHaveType('USLM\Legislation\Element\Action\ActionDesc');
    }

    function it_should_get_the_sponsor() {
      $raw = '<action-desc><sponsor name-id="L000564">Mr. Lamborn</sponsor> introduced the following bill; which was referred to the <committee-name committee-id="HII00">Committee on Natural Resources</committee-name></action-desc>';

      $simplexml = simplexml_load_string($raw);

      $this->simplexml($simplexml);

      $expected = array(
        'name-id' => 'L000564',
        'name'    => 'Mr. Lamborn'
      );

      $this->getSponsor()->shouldReturn($expected);
    }

    function it_should_get_the_cosponsors() {
      $raw = '<action-desc>Additional sponsors: <cosponsor name-id="C001053">Mr. Cole</cosponsor>, <cosponsor name-id="D000600">Mr. Diaz-Balart</cosponsor>, <cosponsor name-id="C001096">Mr. Cramer</cosponsor>, <cosponsor name-id="C001077">Mr. Coffman</cosponsor>, <cosponsor name-id="A000369">Mr. Amodei</cosponsor>, <cosponsor name-id="L000571">Mrs. Lummis</cosponsor>, <cosponsor name-id="S001187">Mr. Stivers</cosponsor>, <cosponsor name-id="M001190">Mr. Mullin</cosponsor>, and <cosponsor name-id="R000593">Mr. Ross</cosponsor></action-desc>';

      $simplexml = simplexml_load_string($raw);

      $this->simplexml($simplexml);

      $expected = array(
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
      );

      $this->getCosponsors()->shouldReturn($expected);
    }
}
