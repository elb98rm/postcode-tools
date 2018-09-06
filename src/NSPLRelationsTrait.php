<?php
/**
 * NSPLRelationsTrait.php
 *
 * NSPLRelationsTrait class
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
 * @see       ../docs/main/objects.md#NSPLRelationsTrait
 * @since     File available since Release 1.0
 *
 */

namespace Floor9design\PostcodeTools;

/**
 * Trait NSPLRelationsTrait
 *
 * A trait offering properties and get accessors for NSPL data relationships.
 * For example:
 * usertype -> 0 maps to: usertype_verbose -> small user
 *
 * @category  None
 * @package   Floor9design\PostcodeTools
 * @author    Rick Morice <rick@floor9design.com>
 * @copyright Floor9design Ltd (floor9design.com)
 * @license   MIT
 * @version   1.0
 * @link      http://floor9design.com
 * @see       ../docs/main/objects.md#NSPLRelationsTrait
 * @since     File available since Release 1.0
 */
trait NSPLRelationsTrait
{
    // Properties

    /**
     * Postcode user verbose
     *
     * @see ../docs/main/nspl_properties.md
     * @see $usertype
     * @var string $usertype_verbose
     */
    protected $usertype_verbose;

    /**
     * Osgrdind verbose
     *
     * @see ../docs/main/nspl_properties.md
     * @see $osgrdind
     * @var string $osgrdind_verbose
     */
    protected $osgrdind_verbose;

    // Accessors

    /**
     * @return int|string
     */
    public function getUsertypeVerbose(): ?string
    {
        return $this->usertype_verbose;
    }

    /**
     * @return int|string
     */
    public function getOsgrdindVerbose(): ?string
    {
        return $this->osgrdind_verbose;
    }

}