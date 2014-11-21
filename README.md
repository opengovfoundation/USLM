USLM
====

[![Build Status](https://travis-ci.org/opengovfoundation/USLM.svg?branch=master)](https://travis-ci.org/opengovfoundation/USLM)

PHP Library for the United Stated Legislative Markup
*Currently tested on 5.4 - 5.6 and HHVM*

[Demo / Test Page](http://uslm-demo.opengovfoundation.org/)

Check out the [Legislation Documentation](LEGISLATION.md)

Check out the [Wiki Home Page](https://github.com/opengovfoundation/USLM/wiki) for the list of top-level structure and elements

##Installation (via Composer)

1. Add the following to your composer.json file:

  > "repositories": [
  >  {
  >      "type": "git",
  >      "url": "https://github.com/opengovfoundation/USLM"
  >  }
  >],
  >"require": {
  >"opengovfoundation/uslm": "dev-master",
  >...
  >...
  >}

2.  Add `require("vendor/autoload.php");` to the start of your application

3.  You can then use the library as follows:

  > $bill = new \USLM\Legislation\HouseBill();