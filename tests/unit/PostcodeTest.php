<?php
/**
 * PostcodeTest.php
 *
 * PostcodeTest class
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
 * @see       ../docs/main/objects.md#Postcode
 * @since     File available since Release 1.0
 *
 */

use Floor9design\PostcodeTools\Postcode;
use PHPUnit\Framework\TestCase;

/**
 * Class PostcodeTest
 *
 * PHPUnit tests.
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
class PostcodeTest extends Testcase
{
    /**
     * @var array $example_postcodes Examples from the wikipedia entry
     */
    protected $example_postcodes = [
        'EC1A 1BB',
        'W1A 0AX',
        'M1 1AE',
        'B33 8TH',
        'CR2 6XH',
        'DN55 1PT'
    ];

    /**
     * @var array $example_postcodes_bad Some examples of badly formatted postcodes
     */
    protected $example_postcodes_bad = [
        'hello world',
        '12S 5F4',
        'LOL OMG',
        'N0$ £'
    ];

    /**
     * @var array $example_areas Examples from the wikipedia entry
     */
    protected $example_areas = ['EC', 'W', 'M', 'B', 'CR', 'DN'];

    /**
     * @var array $example_districts Examples from the wikipedia entry
     */
    protected $example_districts = ['1A', '1A', '1', '33', '2', '55'];

    /**
     * @var array $example_outward_codes Examples from the wikipedia entry
     */
    protected $example_outward_codes = ['EC1A', 'W1A', 'M1', 'B33', 'CR2', 'DN55'];

    /**
     * @var array $example_sector Examples from the wikipedia entry
     */
    protected $example_sectors = ['1', '0', '1', '8', '6', '1'];

    /**
     * @var array $example_units Examples from the wikipedia entry
     */
    protected $example_units = ['BB', 'AX', 'AE', 'TH', 'XH', 'PT'];

    /**
     * @var array $example_inward_codes Examples from the wikipedia entry
     */
    protected $example_inward_codes = ['1BB', '0AX', '1AE', '8TH', '6XH', '1PT'];

    /**
     * Tests the postcode validation - validatePostcode($postcode)
     */
    public function testPostcodeValidation(): void
    {
        $postcode = new Postcode();

        foreach ($this->example_postcodes as $example_postcode) {
            $result = $postcode->validatePostcode($example_postcode);
            $this->assertEquals($result, $example_postcode);
        }

        foreach ($this->example_postcodes_bad as $example_postcode) {
            $result = $postcode->validatePostcode($example_postcode);
            $this->assertNull($result);
        }
    }

    /**
     * Tests the area validation - validateArea($postcode)
     */
    public function testAreaValidation(): void
    {
        $postcode = new Postcode();

        foreach ($this->example_postcodes as $key => $example_postcode) {
            $result = $postcode->validateArea($example_postcode);
            $this->assertEquals($result, $this->example_areas[$key]);
        }
    }

    /**
     * Tests the district validation - validateDistrict($postcode)
     */
    public function testDistrictValidation(): void
    {
        $postcode = new Postcode();

        foreach ($this->example_postcodes as $key => $example_postcode) {
            $result = $postcode->validateDistrict($example_postcode);
            $this->assertEquals($result, $this->example_districts[$key]);
        }
    }

    /**
     * Tests the outward code validation - validateOutwardCode($postcode)
     */
    public function testOutwardCodeValidation(): void
    {
        $postcode = new Postcode();

        foreach ($this->example_postcodes as $key => $example_postcode) {
            $result = $postcode->validateOutwardCode($example_postcode);
            $this->assertEquals($result, $this->example_outward_codes[$key]);
        }
    }

    /**
     * Tests the sector validation - validateSector($postcode)
     */
    public function testSectorValidation(): void
    {
        $postcode = new Postcode();

        foreach ($this->example_postcodes as $key => $example_postcode) {
            $result = $postcode->validateSector($example_postcode);
            $this->assertEquals($result, $this->example_sectors[$key]);
        }
    }

    /**
     * Tests the unit validation - validateUnit($postcode)
     */
    public function testUnitValidation(): void
    {
        $postcode = new Postcode();

        foreach ($this->example_postcodes as $key => $example_postcode) {
            $result = $postcode->validateUnit($example_postcode);
            $this->assertEquals($result, $this->example_units[$key]);
        }
    }

    /**
     * Tests the inward code validation - validateInwardCode($postcode)
     */
    public function testInwardCode(): void
    {
        $postcode = new Postcode();

        foreach ($this->example_postcodes as $key => $example_postcode) {
            $result = $postcode->validateInwardCode($example_postcode);
            $this->assertEquals($result, $this->example_inward_codes[$key]);
        }
    }

    /**
     * Loads a postcode using the validation.
     * Tests all accessors and associated validation.
     */
    public function testLoadPostcode(): void
    {
        $postcode = new Postcode();

        foreach ($this->example_postcodes as $key => $example_postcode) {
            $result = $postcode->loadPostcode($example_postcode);
            $this->assertEquals($result, $example_postcode);
            $this->assertEquals($postcode->getPostcode(), $example_postcode);
            $this->assertEquals($postcode->getArea(), $this->example_areas[$key]);
            $this->assertEquals($postcode->getDistrict(), $this->example_districts[$key]);
            $this->assertEquals($postcode->getOutwardCode(), $this->example_outward_codes[$key]);
            $this->assertEquals($postcode->getSector(), $this->example_sectors[$key]);
            $this->assertEquals($postcode->getUnit(), $this->example_units[$key]);
            $this->assertEquals($postcode->getInwardCode(), $this->example_inward_codes[$key]);
        }
    }
}