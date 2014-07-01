<?php

class USLMTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    protected function _before()
    {
        $this->uslm = new USLM();
    }

    protected function _after()
    {

    }

    // tests
    public function testMe()
    {
        dd($this->uslm);   
    }

}