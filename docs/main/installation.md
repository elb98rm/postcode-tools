# Installation

There are two aspects to installation:

* Codebase (required)
* Datasets (optional)

Installing the codebase will offer tools for a basic Postcode validity check using regex. Installing the datasets will 
offer a database lookup. 

## Codebase

Installation is to be arranged via composer shortly.
In the meantime, clone this from Github.

## Datasets

The raw codebase does not contain any of the datasets. It is not required to use them, but should you want to (which is 
recommended) which needs to be firstly downloaded from the ONS. 

This download should be extracted, and the appropriate files need to be extracted and renamed as required. 

The first step is to download the latest dataset: 

* [geoportal.statistics.gov.uk](http://geoportal.statistics.gov.uk/)

For example, at the time of writing, this is the dataset:

* [NSPL (August 2018)](https://ons.maps.arcgis.com/home/item.html?id=3e4f5ac3c57a418b852a063bbccd8dbc) 

Note: 

* This search doesn't sort by date, so remember to include the year and be sure to select the most recent.
* The columns change infrequently, but do change. This repository is updated and only for use with the most recent version.
* These are typically just short of 200Mb per set to download, and unpack to around a gigabyte (much of which is not 
bundled content not required) 

Once these are downloaded, the files should be converted as per the mappings file:

* [mappings list](mappings.md) 

## Setting up database tables

Once the mappings have been created, the import scripts can be run.

### Standalone code

To set up the database, use `php` to run `/database/develpment/development.php`. 
