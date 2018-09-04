<?php
/**
 * laravel.php
 *
 * Laravel migrations for the database structure.
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
 * @see       /database/development/bootstrap.php
 * @see       /database/migrations/laravel.php
 * @since     File available since Release 1.0
 *
 */

namespace Floor9design\DatabaseTools;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class BaseTables
 *
 * Migrations for laravel
 *
 * @category  None
 * @package   Floor9design\PostcodeTools
 * @author    Rick Morice <rick@floor9design.com>
 * @copyright Floor9design Ltd (floor9design.com)
 * @license   MIT
 * @version   1.0
 * @link      http://floor9design.com
 * @see       ../docs/main/objects.md#Postcode
 * @since     File available since Release 1.0
 */
class BaseTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postcode_nspls', function (Blueprint $table) {
        });

        // to be updated once development.php is tried and tested.
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('postcode_nspls');
    }
}
