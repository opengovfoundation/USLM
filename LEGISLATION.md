# USLM Library Documentation

## Legislation

### Types

* Bills
  * House Bill (HR) **in progress**
  * Senate Bill (S) *unsupported*
* Joint Resolutions *unsupported*
  * House Joint Resolution (HJRES)
  * Senate Joint Resolution (SJRES)
* Concurrent Resolutions *unsupported*
  * House Concurrent Resolution (HCONRES)
  * Senate Concurrent Resolution (SCONRES)
* Simple Resolutions *unsupported*
  * House Simple Resolution (HRES)

#### House Bills (HR)

*This list is not exhaustive, but lists important elements / attributes from the official [DTD](http://www.gpo.gov/fdsys/bulkdata/BILLS/resources/bill.dtd)*

##### Heirarchy

*Many optional entities do not appear below*

* bill
  * metadata
    * dublinCore
      * **(dc:title | dc:publisher | dc:date | dc:format | dc:language | dc:rights)\***
        * dc:title (CDATA)
        * dc:publisher (CDATA)
        * dc:date (CDATA))
        * dc:format (CDATA)
        * dc:language (CDATA)
        * dc:rights (CDATA)
  * form
    * congress
    * session
    * legis-num
    * current-chamber
    * legis-type
    * official-title
  * legis-body
    * 

##### Scratch Notes
* Elements
  * bill
    * pre-form?
    * metadata?
    * form
    * legis-body+
    * official-title-amendment?
    * attestation?
    * endorsement?

* Entities
  * approps-block
    * appropriations-major
    * appropriations-intermediate
    * appropriations-small
  * legis-structures
    * %approps-block;|
    * chapter
    * subdivision
    * division
    * subsection
    * paragraph
    * subparagraph
    * clause
    * subclause
    * item
    * subitem
    * part
    * section
    * subchapter
    * subpart
    * subtitle
    * title

* Attributes (bill)
  * dms-id *implied*
    * **How is this tracked?**
  * dms-version *implied*
    * **How is this tracked?**
  * bill-type = **"olc"**
    * olc
    * traditional
    * appropriations
  * stage-count = **"1"**
    * (1 | 2 | 3)
  * bill-stage *REQUIRED*
    * Additional-Sponsors-House
    * Additional-Sponsors-Senate
    * Agreed-to-House
    * Agreed-to-Senate
    * Amendment-in-House
    * Amendment-in-Senate
    * Committee-Discharged-House
    * Committee-Discharged-Senate
    * Considered-and-Passed-House
    * Considered-and-Passed-Senate
    * Engrossed-Amendment-House
    * Engrossed-Amendment-Senate
    * Engrossed-in-House
    * Engrossed-in-Senate
    * Enrolled-Bill
    * Failed-Amendment-House
    * Failed-Amendment-Senate
    * Failed-Passage-House
    * Failed-Passage-Senate
    * Held-at-Desk-House
    * Held-at-Desk-Senate
    * Indefinitely-Postponed-House
    * Indefinitely-Postponed-Senate
    * Introduced-in-House
    * Introduced-in-Senate
    * Laid-on-Table-House
    * Laid-on-Table-Senate
    * Ordered-to-be-Printed-House
    * Ordered-to-be-Printed-Senate
    * Placed-on-Calendar-House
    * Placed-on-Calendar-Senate
    * Pre-Introduction
    * Re-Enrolled-Bill
    * Received-in-House
    * Received-in-Senate
    * Reengrossed-Amendment-House
    * Reengrossed-Amendment-Senate
    * Reference-Change-House
    * Reference-Change-Senate
    * Referral-Instructions-House
    * Referral-Instructions-Senate
    * Referred-in-House
    * Referred-in-Senate
    * Referred-to-Committee-House
    * Referred-to-Committee-Senate
    * Referred-w-Amendments-House
    * Referred-w-Amendments-Senate
    * Reported-in-House
    * Reported-in-Senate
    * Sponsor-Change
  * public-private (public | private) *REQUIRED*





