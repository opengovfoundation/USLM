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
    $this->getActions()->shouldHaveCount(3);
  }

  function it_should_return_empty_array_if_no_actions() {
    $this->loadRaw('raw1');
    $this->getActions()->shouldHaveCount(0);
  }

  function it_should_return_the_sponsor() {
    $this->loadRaw('raw2');

    $expected = array(
      'name-id' => 'L000564',
      'name'  => 'Mr. Lamborn'
    );

    $this->getSponsor()->shouldBe($expected);
  }

  function it_should_return_the_cosponsors() {
    $this->loadRaw('raw2');

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

    $this->getCosponsors()->shouldBe($expected);
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
