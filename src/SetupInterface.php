<?php
/**
 * SetupInterface.php
 *
 * SetupInterface class
 *
 * php 7.2+
 *
 * @category  None
 * @package   Floor9design\PostcodeTools
 * @author    Rick Morice <rick@floor9design.com>
 * @copyright Floor9design Ltd (floor9design.com)
 * @license   MIT
 * @version   1.0
 * @link      http://floor9design.com
 * @see       ../docs/main/objects.md#SetupInterface
 * @since     File available since Release 1.0
 *
 */

namespace Floor9design\PostcodeTools;

/**
 * Interface SetupInterface
 *
 * A interface for contracting all the table imports.
 *
 * @category  None
 * @package   Floor9design\PostcodeTools
 * @author    Rick Morice <rick@floor9design.com>
 * @copyright Floor9design Ltd (floor9design.com)
 * @license   MIT
 * @version   1.0
 * @link      http://floor9design.com
 * @see       ../docs/main/objects.md#SetupInterface
 * @since     File available since Release 1.0
 */
interface SetupInterface
{

    /**
     * Set up the whole database
     *
     * @return bool
     */
    public function setupAll(): bool;

    /**
     * Sets up and populates the postcode_nspls table
     *
     * @return bool
     */
    public function createPostcodeNspls(): bool;

    /**
     * Sets up and populates the postcode_usertypes table
     *
     * @return bool
     */
    public function createUsertypes(): bool;

    /**
     * Sets up and populates the postcode_osgrdinds table
     *
     * @return bool
     */
    public function createOsgrdinds(): bool;

    /**
     * Sets up and populates the postcode_counties table
     *
     * @return bool
     */
    public function createCounties(): bool;

    /**
     * Sets up and populates the postcode_ceds table
     *
     * @return bool
     */
    public function createCeds(): bool;

    /**
     * Sets up and populates the postcode_lauas table
     *
     * @return bool
     */
    public function createLauas(): bool;

    /**
     * Sets up and populates the postcode_wards table
     *
     * @return bool
     */
    public function createWards(): bool;

    /**
     * Sets up and populates the postcode_hlthaus table
     *
     * @return bool
     */
    public function createHlthaus(): bool;

    /**
     * Sets up and populates the postcode_nhsers table
     *
     * @return bool
     */
    public function createNhsers(): bool;

    /**
     * Sets up and populates the postcode_countries table
     *
     * @return bool
     */
    public function createCountries(): bool;

    /**
     * Sets up and populates the postcode_rgns table
     *
     * @return bool
     */
    public function createRgns(): bool;

    /**
     * Sets up and populates the postcode_pcons table
     *
     * @return bool
     */
    public function createPcons(): bool;

    /**
     * Sets up and populates the postcode_eers table
     *
     * @return bool
     */
    public function createEers(): bool;

    /**
     * Sets up and populates the postcode_teclecs table
     *
     * @return bool
     */
    public function createTeclecs(): bool;

    /**
     * Sets up and populates the postcode_ttwas table
     *
     * @return bool
     */
    public function createTtwas(): bool;

    /**
     * Sets up and populates the postcode_pcts table
     *
     * @return bool
     */
    public function createPcts(): bool;

    /**
     * Sets up and populates the postcode_nutss table
     *
     * @return bool
     */
    public function createNutss(): bool;

    /**
     * Sets up and populates the postcode_parks table
     *
     * @return bool
     */
    public function createParks(): bool;

    /**
     * Sets up and populates the postcode_ccgs table
     *
     * @return bool
     */
    public function createCcgs(): bool;

    /**
     * Sets up and populates the postcode_bua11s table
     *
     * @return bool
     */
    public function createBua11s(): bool;

    /**
     * Sets up and populates the postcode_buasd11s table
     *
     * @return bool
     */
    public function createBuasd11(): bool;

    /**
     * Sets up and populates the postcode_ru11inds table
     *
     * @return bool
     */
    public function createRu11ind(): bool;

    /**
     * Sets up and populates the postcode_oac11s table
     *
     * @return bool
     */
    public function createOac11(): bool;

    /**
     * Sets up and populates the postcode_leps table
     *
     * @return bool
     */
    public function createLeps(): bool;

}