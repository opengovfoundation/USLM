<?php

namespace spec\USLM\Legislation\Element;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TableSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('USLM\Legislation\Element\Table');
    }

    function it_should_return_markdown() {
      $raw = $this->getRawTable();
      $expected = $this->getMarkdownTable();

      $this->simplexml($raw);
      $this->asMarkdown()->shouldBe($expected);
    }

    function it_should_convert_rows_to_markdown(){
      $row =  array("Pay grade", "Monthly rate", "Pay grade", "Monthly rate");
      $widths = array(9, 12, 9, 12);

      $expected = "| Pay grade | Monthly rate | Pay grade | Monthly rate |";

      $this->rowToMarkdown($row, $widths)->shouldBe($expected);
    }

    function it_should_return_the_body(){
      $raw = $this->getRawTable();
      $expected = array(
          array("E–1", "$1,572.03", "W–4", "$1,651.78", ""),
          array("E–2", "$1,572.03", "O–1", "$1,572.03", ""),
          array("E–3", "$1,572.03", "O–2", "$1,572.03", ""),
          array("E–4", "$1,572.03", "O–3", "$1,611.98", ""),
          array("E–5", "$1,572.03", "O–4", "$1,708.61", ""),
          array("E–6", "$1,572.03", "O–5", "$1,880.27", ""),
          array("E–7", "$1,572.03", "O–6", "$2,120.13", ""),
          array("E–8", "$1,572.03", "O–7", "$2,288.38", ""),
          array("E–9", "$1,573.33^1^", "O–8", "$2,513.46", ""),
          array("W–1", "$1,572.03", "O–9", "$2,688.53", ""),
          array("W–2", "$1,572.03", "O–10", "$2,948.86^2^", ""),
          array("W–3", "$1,572.03", "", "", "")
      );

      $this->simplexml($raw);
      $this->getBody()->shouldBe($expected);
    }

    function it_should_return_the_headers(){
      $raw = $this->getRawTable();
      $expected = array("Pay grade", "Monthly rate", "Pay grade", "Monthly rate", "");

      $this->simplexml($raw);

      $this->getHeaders()->shouldBe($expected);
    }

    function it_should_parse_entries(){
      $entry = simplexml_load_string('<entry align="right" colname="column4" leader-modify="clr-ldr">$2,948.86<superscript>2</superscript></entry>');

      $expected = "$2,948.86^2^";

      $this->parseEntry($entry)->shouldBe($expected);
    }

    function it_should_calculate_column_widths(){
      $table = array(
          array("Pay grade", "Monthly rate", "Pay grade", "Monthly rate", ""),
          array("E–1", "$1,572.03", "W–4", "$1,651.78", ""),
          array("E–2", "$1,572.03", "O–1", "$1,572.03", ""),
          array("E–3", "$1,572.03", "O–2", "$1,572.03", ""),
          array("E–4", "$1,572.03", "O–3", "$1,611.98", ""),
          array("E–5", "$1,572.03", "O–4", "$1,708.61", ""),
          array("E–6", "$1,572.03", "O–5", "$1,880.27", ""),
          array("E–7", "$1,572.03", "O–6", "$2,120.13", ""),
          array("E–8", "$1,572.03", "O–7", "$2,288.38", ""),
          array("E–9", "$1,573.33^1^", "O–8", "$2,513.46", ""),
          array("W–1", "$1,572.03", "O–9", "$2,688.53", ""),
          array("W–2", "$1,572.03", "O–10", "$2,948.86^2^", ""),
          array("W–3", "$1,572.03", "", "", "")
      );

      $expected = array(9, 12, 9, 12, 0);

      $this->getColumnWidths($table)->shouldBe($expected);
    }

    protected function getMarkdownTable() {
      $expected = "";
      $expected .= "| Pay grade | Monthly rate | Pay grade | Monthly rate |  |\n";
      $expected .= "----------------------------------------------------------\n";
      $expected .= "| E–1       | $1,572.03    | W–4       | $1,651.78    |  |\n";
      $expected .= "| E–2       | $1,572.03    | O–1       | $1,572.03    |  |\n";
      $expected .= "| E–3       | $1,572.03    | O–2       | $1,572.03    |  |\n";
      $expected .= "| E–4       | $1,572.03    | O–3       | $1,611.98    |  |\n";
      $expected .= "| E–5       | $1,572.03    | O–4       | $1,708.61    |  |\n";
      $expected .= "| E–6       | $1,572.03    | O–5       | $1,880.27    |  |\n";
      $expected .= "| E–7       | $1,572.03    | O–6       | $2,120.13    |  |\n";
      $expected .= "| E–8       | $1,572.03    | O–7       | $2,288.38    |  |\n";
      $expected .= "| E–9       | $1,573.33^1^ | O–8       | $2,513.46    |  |\n";
      $expected .= "| W–1       | $1,572.03    | O–9       | $2,688.53    |  |\n";
      $expected .= "| W–2       | $1,572.03    | O–10      | $2,948.86^2^ |  |\n";
      $expected .= "| W–3       | $1,572.03    |           |              |  |\n";
      $expected .= "----------------------------------------------------------";
      
      return $expected;
    }

    protected function getRawTable(){
      return '<table align-to-level="section" blank-lines-before="1" colsep="0" frame="topbot" line-rules="hor" rowsep="0" rule-weights="4.4.4.0.0.0" table-template-name="Generic: 1text, 1num, 1text, 1num" table-type="">
                  <tgroup cols="5" grid-typeface="1.1" rowsep="0" thead-tbody-ldg-size="10.10.12">
                    <colspec align="center" coldef="txt-no-ldr" colname="column1" colnum="0" colwidth="86pts" min-data-value="85"/>
                    <colspec align="center" coldef="fig" colname="column2" colnum="1" colwidth="56pts" min-data-value="10"/>
                    <colspec align="center" coldef="txt" colname="column3" colnum="2" colwidth="86pts" min-data-value="85"/>
                    <colspec align="center" coldef="fig" colname="column4" colnum="3" colwidth="56pts" min-data-value="10"/>
                    <colspec align="right" coldef="txt-no-ldr" colname="column5" colnum="4" colwidth="7pts" min-data-value="7"/>
                    <thead>
                      <row>
                        <entry align="center" colname="column1" morerows="0" namest="column1">Pay grade</entry>
                        <entry align="center" colname="column2" morerows="0" namest="column2">Monthly rate</entry>
                        <entry align="center" colname="column3" morerows="0" namest="column3">Pay grade</entry>
                        <entry align="center" colname="column4" morerows="0" namest="column4">Monthly rate</entry>
                        <entry colname="column5" morerows="0" namest="column5"/>
                      </row>
                    </thead>
                    <tbody>
                      <row>
                        <entry align="left" colname="column1" leader-modify="clr-ldr" stub-definition="txt-ldr" stub-hierarchy="1">E&#x2013;1</entry>
                        <entry align="right" colname="column2" leader-modify="clr-ldr">$1,572.03</entry>
                        <entry align="left" colname="column3" leader-modify="clr-ldr">W&#x2013;4</entry>
                        <entry align="right" colname="column4" leader-modify="clr-ldr">$1,651.78</entry>
                        <entry colname="column5" leader-modify="clr-ldr"/>
                      </row>
                      <row>
                        <entry align="left" colname="column1" leader-modify="clr-ldr" stub-definition="txt-ldr" stub-hierarchy="1">E&#x2013;2</entry>
                        <entry align="right" colname="column2" leader-modify="clr-ldr">$1,572.03</entry>
                        <entry align="left" colname="column3" leader-modify="clr-ldr">O&#x2013;1</entry>
                        <entry align="right" colname="column4" leader-modify="clr-ldr">$1,572.03</entry>
                        <entry colname="column5" leader-modify="clr-ldr"/>
                      </row>
                      <row>
                        <entry align="left" colname="column1" leader-modify="clr-ldr" stub-definition="txt-ldr" stub-hierarchy="1">E&#x2013;3</entry>
                        <entry align="right" colname="column2" leader-modify="clr-ldr">$1,572.03</entry>
                        <entry align="left" colname="column3" leader-modify="clr-ldr">O&#x2013;2</entry>
                        <entry align="right" colname="column4" leader-modify="clr-ldr">$1,572.03</entry>
                        <entry colname="column5" leader-modify="clr-ldr"/>
                      </row>
                      <row>
                        <entry align="left" colname="column1" leader-modify="clr-ldr" stub-definition="txt-ldr" stub-hierarchy="1">E&#x2013;4</entry>
                        <entry align="right" colname="column2" leader-modify="clr-ldr">$1,572.03</entry>
                        <entry align="left" colname="column3" leader-modify="clr-ldr">O&#x2013;3</entry>
                        <entry align="right" colname="column4" leader-modify="clr-ldr">$1,611.98</entry>
                        <entry colname="column5" leader-modify="clr-ldr"/>
                      </row>
                      <row>
                        <entry align="left" colname="column1" leader-modify="clr-ldr" stub-definition="txt-ldr" stub-hierarchy="1">E&#x2013;5</entry>
                        <entry align="right" colname="column2" leader-modify="clr-ldr">$1,572.03</entry>
                        <entry align="left" colname="column3" leader-modify="clr-ldr">O&#x2013;4</entry>
                        <entry align="right" colname="column4" leader-modify="clr-ldr">$1,708.61</entry>
                        <entry colname="column5" leader-modify="clr-ldr"/>
                      </row>
                      <row>
                        <entry align="left" colname="column1" leader-modify="clr-ldr" stub-definition="txt-ldr" stub-hierarchy="1">E&#x2013;6</entry>
                        <entry align="right" colname="column2" leader-modify="clr-ldr">$1,572.03</entry>
                        <entry align="left" colname="column3" leader-modify="clr-ldr">O&#x2013;5</entry>
                        <entry align="right" colname="column4" leader-modify="clr-ldr">$1,880.27</entry>
                        <entry colname="column5" leader-modify="clr-ldr"/>
                      </row>
                      <row>
                        <entry align="left" colname="column1" leader-modify="clr-ldr" stub-definition="txt-ldr" stub-hierarchy="1">E&#x2013;7</entry>
                        <entry align="right" colname="column2" leader-modify="clr-ldr">$1,572.03</entry>
                        <entry align="left" colname="column3" leader-modify="clr-ldr">O&#x2013;6</entry>
                        <entry align="right" colname="column4" leader-modify="clr-ldr">$2,120.13</entry>
                        <entry colname="column5" leader-modify="clr-ldr"/>
                      </row>
                      <row>
                        <entry align="left" colname="column1" leader-modify="clr-ldr" stub-definition="txt-ldr" stub-hierarchy="1">E&#x2013;8</entry>
                        <entry align="right" colname="column2" leader-modify="clr-ldr">$1,572.03</entry>
                        <entry align="left" colname="column3" leader-modify="clr-ldr">O&#x2013;7</entry>
                        <entry align="right" colname="column4" leader-modify="clr-ldr">$2,288.38</entry>
                        <entry colname="column5" leader-modify="clr-ldr"/>
                      </row>
                      <row>
                        <entry align="left" colname="column1" leader-modify="clr-ldr" stub-definition="txt-ldr" stub-hierarchy="1">E&#x2013;9</entry>
                        <entry align="right" colname="column2" leader-modify="clr-ldr">$1,573.33<superscript>1</superscript></entry>
                        <entry align="left" colname="column3" leader-modify="clr-ldr">O&#x2013;8</entry>
                        <entry align="right" colname="column4" leader-modify="clr-ldr">$2,513.46</entry>
                        <entry colname="column5" leader-modify="clr-ldr"/>
                      </row>
                      <row>
                        <entry align="left" colname="column1" leader-modify="clr-ldr" stub-definition="txt-ldr" stub-hierarchy="1">W&#x2013;1</entry>
                        <entry align="right" colname="column2" leader-modify="clr-ldr">$1,572.03</entry>
                        <entry align="left" colname="column3" leader-modify="clr-ldr">O&#x2013;9</entry>
                        <entry align="right" colname="column4" leader-modify="clr-ldr">$2,688.53</entry>
                        <entry colname="column5" leader-modify="clr-ldr"/>
                      </row>
                      <row>
                        <entry align="left" colname="column1" leader-modify="clr-ldr" stub-definition="txt-ldr" stub-hierarchy="1">W&#x2013;2</entry>
                        <entry align="right" colname="column2" leader-modify="clr-ldr">$1,572.03</entry>
                        <entry align="left" colname="column3" leader-modify="clr-ldr">O&#x2013;10</entry>
                        <entry align="right" colname="column4" leader-modify="clr-ldr">$2,948.86<superscript>2</superscript></entry>
                        <entry colname="column5" leader-modify="clr-ldr"/>
                      </row>
                      <row>
                        <entry align="left" colname="column1" leader-modify="clr-ldr" stub-definition="txt-ldr" stub-hierarchy="1">W&#x2013;3</entry>
                        <entry align="right" colname="column2" leader-modify="clr-ldr">$1,572.03</entry>
                        <entry colname="column3" leader-modify="clr-ldr"/>
                        <entry align="right" colname="column4" leader-modify="clr-ldr"/>
                        <entry colname="column5" leader-modify="clr-ldr"/>
                      </row>
                    </tbody>
                  </tgroup>
                </table>';
    }
}
