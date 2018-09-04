<?php
/**
 * development.php
 *
 * Runs a migration script, setting up the database and importing all data.
 * Use this if outside the laravel framework as discussed in the documentation
 *
 * php 7.2+
 *
 * @catergny  None
 * @package   Floor9design\DatabaseTools
 * @author    Rick Morice <rick@floor9design.com>
 * @copyright Floor9design Ltd (floor9design.com)
 * @license   MIT
 * @version   1.0
 * @link      http://floor9design.com
 * @see       /database/development/bootstrap.php
 * @see       /database/migrations/laravel.php
 * @since     File available since Release 1.0
 *
 */

namespace Floor9design\DatabaseTools;

require "bootstrap.php";

use Floor9design\PostcodeTools\DevelopmentSetup;

// set up tables
$development_setup = new DevelopmentSetup();
$development_setup->setupAll();


