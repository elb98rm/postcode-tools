<?php
/**
 * Postcode.php
 *
 * Postcode class
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

namespace Floor9design\PostcodeTools;

/**
 * Class Postcode
 *
 * Models a UK postcode offering for functions for analysis.
 * Note, set accessors are protected to force validation.
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
class Postcode
{
    // Properties

    /**
     * A full postcode is known as a "postcode unit" and designates an area with a number of addresses or a single
     * major delivery point
     *
     * For example:
     * "S1 1DJ" (Republic nightclub - RIP)
     * "GL51 0EX" (GCHQ)
     *
     * @var string $postcode
     */
    protected $postcode;

    /**
     * A postcode area is a one or two-letter postcode area code named after a local city, town or area of London
     *
     * For example: "S", "GL"
     *
     * @var string $area
     */
    protected $area;

    /**
     * A postcode area district is a up to two-digit postcode area code named after a local city, town or area of London
     *
     * For example: "1", "51"
     *
     * @var int $district
     */
    protected $district;

    /**
     * The outward code is the part of the postcode before the single space in the middle
     *
     * For example: "S1", "GL51"
     *
     * @var int $outward_code
     */
    protected $outward_code;

    /**
     * A sector_character is the character following the postcode space
     *
     * For example: "1", "0"
     *
     * @var int $sector_character
     */
    protected $sector_character;

    /**
     * A postcode sector is made up of the postcode district, the single space, and the first character of the inward
     * code
     *
     * For example: "S1 1", "GL51 0"
     *
     * @var string $sector
     */
    protected $sector;

    /**
     * The unit is two characters added to the end of the postcode sector. Each postcode unit generally
     * represents a street, part of a street, a single address, a group of properties, a single property, a sub-section
     * of the property, an individual organisation or (for instance Driver and Vehicle Licensing Agency) a subsection
     * of the organisation.
     *
     * For example: "DJ", "EX"
     *
     * @var string $unit
     */
    protected $unit;

    /**
     * The outward code is the part of the postcode after the single space in the middle
     *
     * For example: "1DJ", "0EX"
     *
     * @var int inward_code
     */
    protected $inward_code;

    /**
     * "The UK government has [..] provided the following regular expression [..] for the purpose of validation"
     * Modified to work in php (added /)
     *
     * @var string $postcode_regex
     */
    protected $postcode_regex = '/^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) [0-9][A-Za-z]{2})$/';

    // from these we can create:

    /**
     * The postcode area, for example: EC, W, M, B, CR, DN
     *
     * @var string $area_regex
     */
    protected $area_regex = '/([Gg][Ii][Rr])|(([A-Za-z][A-Ha-hJ-Yj-y])|([A-Za-z]{1}))/';

    /**
     * The postcode district: 1A, 1A, 1, 33, 2, 55.
     *
     * @var string $district_regex
     */
    protected $district_regex = '/([0-9]{1}[A-Ha-hJ-Yj-y])|([0-9]{1,2})/';

    /**
     * The outward code regex: SW1W, W1A, M1, B33, CR2, DN55.
     *
     * @var string $outward_code_regex
     */
    protected $outward_code_regex = '/([Gg][Ii][Rr]|(((([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z]))|([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})))))/';

    /**
     * The sector regex: 1, 0, 1, 8, 6, 1.
     *
     * @var string $sector_regex
     */
    protected $sector_regex = '/ ([0-9])[A-Za-z]{2}/';

    /**
     * The outward code regex: SW1W, W1A, M1, B33, CR2, DN55.
     *
     * @var string $outward_code_regex
     */
    protected $unit_regex = '/\s[0-9]([A-Za-z]{2})/';

    /**
     * The inward code regex: 1BB, 0AX, 1AE, 8TH, 6XH, 1PT.
     *
     * @var string $outward_code_regex
     */
    protected $inward_code_regex = '/\s([0-9][A-Za-z]{2})/';

    // Accessors

    /**
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * This is protected to stop invalid postcodes. The function you probably want to use is: loadPostcode()
     *
     * @see Postcode::loadPostcode()
     *
     * @param string $postcode
     *
     * @return Postcode
     */
    protected function setPostcode(string $postcode): Postcode
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * @return string
     */
    public function getArea(): string
    {
        return $this->area;
    }

    /**
     * Protected as for internal use only. Update this by using loadPostcode()
     *
     * @see Postcode::loadPostcode()
     *
     * @param string $area
     *
     * @return Postcode
     */
    protected function setArea(string $area): Postcode
    {
        $this->area = $area;

        return $this;
    }

    /**
     * @return string
     */
    public function getDistrict(): string
    {
        return $this->district;
    }

    /**
     * Protected as for internal use only. Update this by using loadPostcode()
     *
     * @see Postcode::loadPostcode()
     *
     * @param string $district
     *
     * @return Postcode
     */
    protected function setDistrict(string $district): Postcode
    {
        $this->district = $district;

        return $this;
    }

    /**
     * @return string
     */
    public function getOutwardCode(): string
    {
        return $this->outward_code;
    }

    /**
     * Protected as for internal use only. Update this by using loadPostcode()
     *
     * @see Postcode::loadPostcode()
     *
     * @param string $outward_code
     *
     * @return Postcode
     */
    protected function setOutwardCode(string $outward_code): Postcode
    {
        $this->outward_code = $outward_code;

        return $this;
    }

    /**
     * @return int
     */
    public function getSectorCharacter(): int
    {
        return $this->sector_character;
    }

    /**
     * Protected as for internal use only. Update this by using loadPostcode()
     *
     * @see Postcode::loadPostcode()
     *
     * @param int $sector_character
     *
     * @return Postcode
     */
    protected function setSectorCharacter(int $sector_character): Postcode
    {
        $this->sector_character = $sector_character;
    }

    /**
     * @return string
     */
    public function getSector(): string
    {
        return $this->sector;
    }

    /**
     * Protected as for internal use only. Update this by using loadPostcode()
     *
     * @see Postcode::loadPostcode()
     *
     * @param string $sector
     *
     * @return Postcode
     */
    protected function setSector(string $sector): Postcode
    {
        $this->sector = $sector;

        return $this;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * Protected as for internal use only. Update this by using loadPostcode()
     *
     * @see Postcode::loadPostcode()
     *
     * @param string $unit
     *
     * @return Postcode
     */
    protected function setUnit(string $unit): Postcode
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * @return string
     */
    public function getInwardCode(): string
    {
        return $this->inward_code;
    }

    /**
     * Protected as for internal use only. Update this by using loadPostcode()
     *
     * @see Postcode::loadPostcode()
     *
     * @param string $inward_code
     *
     * @return Postcode
     */
    public function setInwardCode(string $inward_code): Postcode
    {
        $this->inward_code = $inward_code;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostcodeRegex(): string
    {
        return $this->postcode_regex;
    }

    /**
     * @return string
     */
    public function getAreaRegex(): string
    {
        return $this->area_regex;
    }

    /**
     * @return string
     */
    public function getDistrictRegex(): string
    {
        return $this->district_regex;
    }

    /**
     * @return string
     */
    public function getOutwardCodeRegex(): string
    {
        return $this->outward_code_regex;
    }

    /**
     * @return string
     */
    protected function getSectorRegex(): string
    {
        return $this->sector_regex;
    }

    /**
     * @return string
     */
    public function getUnitRegex(): string
    {
        return $this->unit_regex;
    }

    /**
     * @return string
     */
    public function getInwardCodeRegex(): string
    {
        return $this->inward_code_regex;
    }

    // General methods

    /**
     * Validates a postcode: returns the postcode if valid, false otherwise.
     *
     * @param string $postcode
     *
     * @return null|string
     */
    public function validatePostcode(string $postcode): ?string
    {
        $matches = [];
        preg_match($this->getPostcodeRegex(), $postcode, $matches);

        if (count($matches)) {
            return $matches[0];
        } else {
            return null;
        }
    }

    /**
     * Validates an area: returns the area if valid, false otherwise.
     * This also strips the string: so using a full postcode will only return an area
     *
     * @param string $area
     *
     * @return null|string
     */
    public function validateArea(string $area): ?string
    {
        $matches = [];
        preg_match($this->getAreaRegex(), $area, $matches);

        if (count($matches)) {
            return $matches[0];
        } else {
            return null;
        }
    }

    /**
     * Validates a district: returns the district if valid, false otherwise.
     * This also strips the string: so using a full postcode will only return a district
     *
     * @param string $district
     *
     * @return null|string
     */
    public function validateDistrict(string $district): ?string
    {
        $matches = [];
        preg_match($this->getDistrictRegex(), $district, $matches);

        if (count($matches)) {
            return $matches[0];
        } else {
            return null;
        }
    }

    /**
     * Validates an outward_code: returns the outward_code if valid, false otherwise.
     * This also strips the string: so using a full postcode will only return an outward_code
     *
     * @param string $outward_code
     *
     * @return null|string
     */
    public function validateOutwardCode(string $outward_code): ?string
    {
        $matches = [];
        preg_match($this->getOutwardCodeRegex(), $outward_code, $matches);

        if (count($matches)) {
            return $matches[0];
        } else {
            return null;
        }
    }

    /**
     * Validates a sector: returns the sector if valid, false otherwise.
     * This also strips the string: so using a full postcode will only return a sector
     *
     * @param string $sector
     *
     * @return null|string
     */
    public function validateSector(string $sector): ?string
    {
        $matches = [];
        preg_match($this->getSectorRegex(), $sector, $matches);

        if (count($matches)) {
            return $matches[1];
        } else {
            return null;
        }
    }

    /**
     * Validates a unit: returns the unit if valid, false otherwise.
     * This also strips the string: so using a full postcode will only return a unit
     *
     * @param string $unit
     *
     * @return null|string
     */
    public function validateUnit(string $unit): ?string
    {
        $matches = [];
        preg_match($this->getUnitRegex(), $unit, $matches);

        if (count($matches)) {
            return $matches[1];
        } else {
            return null;
        }
    }

    /**
     * Validates an inward_code: returns the inward_code if valid, false otherwise.
     * This also strips the string: so using a full postcode will only return an inward_code
     *
     * @param string $inward_code
     *
     * @return null|string
     */
    public function validateInwardCode(string $inward_code): ?string
    {
        $matches = [];
        preg_match($this->getInwardCodeRegex(), $inward_code, $matches);

        if (count($matches)) {
            return $matches[1];
        } else {
            return null;
        }
    }

    /**
     * This takes a string and fully parses it into the system.
     * This is the public method, other is protected to ensure parsing is done properly.
     *
     * @see Postcode::setPostcode()
     *
     * @param string $postcode
     *
     * @return null|string
     */
    public function loadPostcode(string $postcode): ?string
    {
        $postcode = $this->validatePostcode($postcode);

        if ($postcode) {
            $this->setPostcode($postcode)
                 ->setArea($this->validateArea($postcode))
                 ->setDistrict($this->validateDistrict($postcode))
                 ->setOutwardCode($this->validateOutwardCode($postcode))
                 ->setSector($this->validateSector($postcode))
                 ->setUnit($this->validateUnit($postcode))
                 ->setInwardCode($this->validateInwardCode($postcode));

            return $postcode;
        } else {
            return null;
        }
    }

}