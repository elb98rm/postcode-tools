# floor9design/postcode-tools

This is a set of tools for getting relevant data from UK postcodes. 

## Summary

This repo offers some useful tools for processing UK postcodes. The UK postcodes have been released under the UK's 
National Statistics Postcode Lookup from the Office for National Statistics. It is open source, but there are 
restrictions (historic and ongoing) on processing and releasing this data. 

This set of tools should allow a user to take this and appropriately analyse for use by other people.
It will allow a processing of raw csv data from the ONS into a database, as well as other analysis tools such as a 
batch postcode lookup, postcode validator, and postcode distance calculator.

## Installation
 
This is discussed within the [installation](docs/main/installation.md) section.

## Requirements

This repository uses the following other components:

### Required components:

* php : >=7.2
* doctrine/dbal : >=2.7
* illuminate/database : >=5.6.28

### Development components

* phpunit/phpunit : 7.*
* phpunit/php-code-coverage : >=6
* mockery/mockery : dev-master
* phpdocumentor/phpdocumentor : 2.*

## Licensing

This codebase uses the MIT license. It is listed here:

* [Licence](LICENSE) 

The data license is not true open source, but is open. More information is here:

* [Data licence](https://www.ons.gov.uk/methodology/geography/licences)

## Updates

This repo will be updated regularly for two reasons:

* the data is updated every few months by the Office for National Statistics
* bug fixes/feature implementations

## Future development

The repo is currently standalone. Thus it can be used within other frameworks. 

However, for ease of use, it will be shortly to be extended to be more friendly with:

* laravel
* cakephp
* ... etc