<?php
/**
 * bootstrap.php
 *
 * Bootstrap functionality for running migrations without a framework.
 * As discussed in the documentation
 *
 * php 7.2+
 *
 * @category  None
 * @package   Floor9design\DatabaseTools
 * @author    Rick Morice <rick@floor9design.com>
 * @copyright Floor9design Ltd (floor9design.com)
 * @license   MIT
 * @version   1.0
 * @link      http://floor9design.com
 * @see       ../docs/main/objects.md#DevelopmentConnection
 * @since     File available since Release 1.0
 *
 */

namespace Floor9design\DatabaseTools;

use Illuminate\Database\Capsule\Manager as Capsule;

$connection_params = [];
if (file_exists('../../config/database.php')) {
    // load temporary connection params
    require('../../config/database.php');
}

require "../../vendor/autoload.php";

$capsule = new Capsule;
$capsule->addConnection($connection_params);

//Make this Capsule instance available globally.
$capsule->setAsGlobal();

// Setup the Eloquent ORM.
$capsule->bootEloquent();