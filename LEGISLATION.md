# USLM Library Documentation

## Legislation

### Status

This library can currently grab the following from a House Bill (HR):

**DMS Id**
> getDMSId()

> ex: H7601F8A0A016467483629C41354A77B9

**Bill Stage**
> getBillStage()

> ex: Engrossed-in-House

**Congress**
> getCongress()

> ex: 113th CONGRESS

**Session**
> getSession()

> ex: 2d Session

**Legis Num**
> getLegisNum()

> ex: H. R. 10

**Current Chamber**
> getCurrentChamber()

> ex: IN THE HOUSE OF REPRESENTATIVES

**Legis Type**
> getLegisType()

> ex: AN ACT

**Official Title**
> getOfficialTitle()

> ex: To amend the charter school program under the Elementary and Secondary Education Act of 1965.

**Actions**
> getActions()

> returns array of action arrays

**Sponsor**
> getSponsor()

> returns sponsor array with keys 'name-id' and 'name'

**Cosponsors**
> getCosponsors()

> returns array of cosponsor arrays each having keys 'name-id' and 'name'


**Committees**
> getCommittees()

> returns array of committee arrays each having keys 'committee-id' and 'committee-name'

**Markdown**
>getBodyAsMarkdown()

> returns bill body as markdown string

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

##### Heirarchy **in progress**

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





