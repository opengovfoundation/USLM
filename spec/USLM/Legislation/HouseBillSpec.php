<?php

namespace spec\USLM\Legislation;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HouseBillSpec extends ObjectBehavior
{

  function it_is_initializable()
  {
      $this->shouldHaveType('USLM\Legislation\HouseBill');
  }

  function it_should_load_the_xml() {
    $raw = file_get_contents(__DIR__ . '/../../data/valid1.xml');

    $this->loadXML($raw)->shouldReturn(true);
  }

  function it_should_get_the_dms_id() {
    $raw = file_get_contents(__DIR__ . '/../../data/valid1.xml');
    $this->loadXML($raw);

    $this->getDMSId()->shouldReturn('H7601F8A0A016467483629C41354A77B9');
  }

  function it_should_get_the_body(){
    $raw = file_get_contents(__DIR__ . '/../../data/valid1.xml');
    $this->loadXML($raw);

    $this->getBody()->shouldReturnAnInstanceOf('SimpleXMLElement');
  }

  function it_should_get_the_form(){
    $raw = file_get_contents(__DIR__ . '/../../data/valid1.xml');
    $this->loadXML($raw);

    $this->getForm()->shouldReturnAnInstanceOf('SimpleXMLElement');
  }

  function it_should_get_the_bill_stage(){
    $raw = file_get_contents(__DIR__ . '/../../data/valid1.xml');
    $this->loadXML($raw);

    $this->getBillStage()->shouldBeEqualTo('Engrossed-in-House');
  }

  function it_should_get_the_congress(){
    $raw = file_get_contents(__DIR__ . '/../../data/valid1.xml');
    $this->loadXML($raw);

    $this->getCongress()->shouldBeEqualTo('113th CONGRESS');
  }

  function it_should_get_the_session(){
    $raw = file_get_contents(__DIR__ . '/../../data/valid1.xml');
    $this->loadXML($raw);

    $this->getSession()->shouldBeEqualTo('2d Session');

  }

  function it_should_get_the_legis_num(){
    $raw = file_get_contents(__DIR__ . '/../../data/valid1.xml');
    $this->loadXML($raw);

    $this->getLegisNum()->shouldBeEqualTo('H. R. 10');
  }

  function it_should_get_the_current_chamber(){
    $raw = file_get_contents(__DIR__ . '/../../data/valid1.xml');
    $this->loadXML($raw);

    $this->getCurrentChamber()->shouldBeEqualTo('IN THE HOUSE OF REPRESENTATIVES');
  }

  function it_should_get_the_legis_type(){
    $raw = file_get_contents(__DIR__ . '/../../data/valid1.xml');
    $this->loadXML($raw);

    $this->getLegisType()->shouldBeEqualTo('AN ACT');
  }

  function it_should_get_the_official_title(){
    $raw = file_get_contents(__DIR__ . '/../../data/valid1.xml');
    $this->loadXML($raw);

    $this->getOfficialTitle()->shouldBeEqualTo('To amend the charter school program under the Elementary and Secondary Education Act of 1965.');
  }

  function it_should_return_array_of_actions_if_exist() {
    $raw = file_get_contents(__DIR__ . '/../../data/valid2.xml');
    $this->loadXML($raw);

    $expected = array(
      array(
        'action-date' => 'March 12, 2013',
        'action-desc' => array(
          'text'  => 'Mr. Lamborn introduced the following bill; which was referred to the Committee on Natural Resources',
          'sponsor' => 'Mr. Lamborn',
          'committee-name'  => 'Committee on Natural Resources'
        )
      ),
      array(
        'action-date' => 'April 1, 2014',
        'action-desc' => array(
          'text'  => 'Additional sponsors: Mr. Cole, Mr. Diaz-Balart, Mr. Cramer, Mr. Coffman, Mr. Amodei, Mrs. Lummis, Mr. Stivers, Mr. Mullin, and Mr. Ross',
          'cosponsor' => array(
            'Mr. Cole',
            'Mr. Diaz-Balart',
            'Mr. Cramer',
            'Mr. Coffman',
            'Mr. Amodei',
            'Mrs. Lummis',
            'Mr. Stivers',
            'Mr. Mullin',
            'Mr. Ross'
          )
        )
      ),
      array(
        'action-date' => 'April 1, 2014',
        'action-desc' => array(
          'text'  => 'Committed to the Committee of the Whole House on the State of the Union and ordered to be printed'
        )
      )
    );

    $this->getActions()->shouldBe($expected);
  }

  function it_should_return_empty_array_if_no_actions() {
    $raw = file_get_contents(__DIR__ . '/../../data/valid1.xml');
    $this->loadXML($raw);

    $this->getActions()->shouldBe(array());
  }

}
