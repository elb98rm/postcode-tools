# Objects

## Postcode

This is the main postcode object, and is the main object you probably want to interact with. It implements `NSPLTrait`.

## NSPLTrait

This object models data from the National Statistics Postcode Lookup UK CSV. 
The fields/properties are listed in [nspl_properties](nspl_properties.md). They are protected, but get accessors are 
included for easy access.

## NSPLWriter

This object is used to write this data to database. It includes the set accessors for NSPL data.

---

The `Development` section of the site is to do with data import and interaction. The prefix `Development` is meant to 
imply a framework ambiguous/free connection. 

This software will likely be extended to include direct easy support for other frameworks such as Laravel. Classes for 
Laravel would thus contain the `Laravel` prefix

---

## DevelopmentConnection

The `...Connection` class offers access to a database.

Note:

* basic php cannot tunnel using SSH without considerable effort, thus:
* you will need to set up a locally accessible (insecure) database
* For clarity: a production server will normally have a local database - this should be accessible 

For example, as part of development, a vagrant box was used with MySQL. The MySQL was opened up and this was then used
as a test.

## DevelopmentSetup

The NSPL data has over 30 csv tables. These are implemented as database tables by the `...Setup` class.

## SetupInterface

To ensure all `...Setup` classes setup all necessary files, the `SetupInterface` offers an interface to implement.

