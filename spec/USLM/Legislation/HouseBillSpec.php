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
    $raw = $this->raw1();
    $this->loadXML($raw)->shouldReturn(true);
  }

  function it_should_get_the_dms_id() {
    $this->loadRaw('raw1');
    $this->getDMSId()->shouldReturn('H7601F8A0A016467483629C41354A77B9');
  }

  function it_should_get_the_body(){
    $this->loadRaw('raw1');
    $this->getBody()->shouldReturnAnInstanceOf('SimpleXMLElement');
  }

  function it_should_get_the_form(){
    $this->loadRaw('raw1');
    $this->getForm()->shouldReturnAnInstanceOf('SimpleXMLElement');
  }

  function it_should_get_the_bill_stage(){
    $this->loadRaw('raw1');
    $this->getBillStage()->shouldBeEqualTo('Engrossed-in-House');
  }

  function it_should_get_the_congress(){
    $this->loadRaw('raw1');
    $this->getCongress()->shouldBeEqualTo('113th CONGRESS');
  }

  function it_should_get_the_session(){
    $this->loadRaw('raw1');
    $this->getSession()->shouldBeEqualTo('2d Session');
  }

  function it_should_get_the_legis_num(){
    $this->loadRaw('raw1');
    $this->getLegisNum()->shouldBeEqualTo('H. R. 10');
  }

  function it_should_get_the_current_chamber(){
    $this->loadRaw('raw1');
    $this->getCurrentChamber()->shouldBeEqualTo('IN THE HOUSE OF REPRESENTATIVES');
  }

  function it_should_get_the_legis_type(){
    $this->loadRaw('raw1');
    $this->getLegisType()->shouldBeEqualTo('AN ACT');
  }

  function it_should_get_the_official_title(){
    $this->loadRaw('raw1');
    $this->getOfficialTitle()->shouldBeEqualTo('To amend the charter school program under the Elementary and Secondary Education Act of 1965.');
  }

  function it_should_return_array_of_actions_if_exist() {
    $this->loadRaw('raw2');

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
    $this->loadRaw('raw1');
    $this->getActions()->shouldBe(array());
  }

  protected function raw1(){
    return file_get_contents(__DIR__ . '/../../data/valid1.xml');
  }

  protected function raw2(){
    return file_get_contents(__DIR__ . '/../../data/valid2.xml');
  }

  protected function loadRaw(String $call){
    $raw = $this->$call();
    $this->loadXML($raw);
  }
}
