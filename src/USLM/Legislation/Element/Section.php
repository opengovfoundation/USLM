<?php
/**
* Section Element
*
* Section Model (via http://www.gpo.gov/fdsys/bulkdata/BILLS/resources/bill.dtd):
*   - enum?
*   - header?
*   - text?
*   - (%nonstructured-level-model)*
*   - (subsection* | paragraph* | committee-appointment-paragraph* | (%approps-block)*)
*   - continuation-text?
*/

namespace USLM\Legislation\Element;

use \Exception;

class Section extends Element {
  
  public function __construct($type = null, $name = null, $parent = null, $xml = null){
    parent::__construct($type, $name, $parent, $xml);
    $this->parent = null;
  }
}