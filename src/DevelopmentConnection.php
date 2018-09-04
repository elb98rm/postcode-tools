<?php
/**
 * DevelopmentConnection.php
 *
 * DevelopmentConnection class
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

/**
 * Class DevelopmentConnection
 *
 * It is preferable to use a built in system, but this offers a quick way to get a temporary database connection.
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
 */
class DevelopmentConnection
{

    /**
     * Load as much as possible for quick instantiation within code
     */
    public function __construct() {
        $this->provideConnection();
    }

    /**
     * provide a global connection
     *
     * @return bool
     */
    public function provideConnection(): bool
    {
        if (file_exists('../config/database.php')) {

            $connection_params = [];
            // load temporary connection params
            include_once('../config/database.php');

            $capsule = new Capsule;
            $capsule->addConnection($connection_params);

            //Make this Capsule instance available globally.
            $capsule->setAsGlobal();

            // Setup the Eloquent ORM.
            $capsule->bootEloquent();
            $capsule->bootEloquent();

            return true;
        } else {
            return false;
        }
    }
}