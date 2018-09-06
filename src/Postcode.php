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

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Connection;

/**
 * Class Postcode
 *
 * Models a UK postcode offering for functions for analysis.
 * Note, set accessors are protected to force external validation.
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
    use NSPLTrait;
    use NSPLRelationsTrait;

    // Properties

    /**
     * Statuses of the various Postcode tools/methods.
     *
     * @var array $status
     */
    protected $status = [
        'postcode_load'   => 'Not attempted',
        'db_connection'   => 'Not attempted',
        'postcode_lookup' => 'Not attempted'
    ];

    /**
     * @var Connection $connection Injected Symfony DBAL connection.
     */
    protected $connection;

    /**
     * A full postcode is known as a "postcode unit" and designates an area with a number of addresses or a single
     * major delivery point
     *
     * For example:
     * "S1 1DJ" (Republic nightclub - RIP)
     * "GL51 0EX" (GCHQ)
     *
     * @var null|string $postcode
     */
    protected $postcode;

    /**
     * A postcode area is a one or two-letter postcode area code named after a local city, town or area of London
     *
     * For example: "S", "GL"
     *
     * @var null|string $area
     */
    protected $area;

    /**
     * A postcode area district is a up to two-digit postcode area code named after a local city, town or area of London
     *
     * For example: "1", "51"
     *
     * @var null|int $district
     */
    protected $district;

    /**
     * The outward code is the part of the postcode before the single space in the middle
     *
     * For example: "S1", "GL51"
     *
     * @var null|int $outward_code
     */
    protected $outward_code;

    /**
     * A sector_character is the character following the postcode space
     *
     * For example: "1", "0"
     *
     * @var null|int $sector_character
     */
    protected $sector_character;

    /**
     * A postcode sector is made up of the postcode district, the single space, and the first character of the inward
     * code
     *
     * For example: "S1 1", "GL51 0"
     *
     * @var null|string $sector
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
     * @var null|string $unit
     */
    protected $unit;

    /**
     * The outward code is the part of the postcode after the single space in the middle
     *
     * For example: "1DJ", "0EX"
     *
     * @var null|int inward_code
     */
    protected $inward_code;

    /**
     * @var null|string $region The region of the country for this postcode
     */
    protected $region;

    /**
     * @var null|string $country Country for this postcode
     */
    protected $country;

    /**
     * @var null|string $hpi_region The UK House Price Index for the region
     */
    protected $hpi_region;

    /**
     * @var null|string $itv_region The ITV region for the postcode
     */
    protected $itv_region;

    // REGEX

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
     * @return null|Connection
     */
    public function getConnection(): ?Connection
    {
        return $this->connection;
    }

    /**
     * @param null|Connection $connection
     *
     * @see Connection
     *
     * @return Postcode
     */
    public function setConnection(?Connection $connection): Postcode
    {
        $this->connection = $connection;

        return $this;
    }

    /**
     * @return array
     */
    public function getStatus(): array
    {
        return $this->status;
    }

    /**
     * @return null|string
     */
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    /**
     * This is protected to stop invalid postcodes. The function you probably want to use is: loadPostcode()
     *
     * @see Postcode::loadPostcode()
     *
     * @param null|string $postcode
     *
     * @return Postcode
     */
    protected function setPostcode(?string $postcode): Postcode
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getArea(): ?string
    {
        return $this->area;
    }

    /**
     * Protected as for internal use only. Update this by using loadPostcode()
     *
     * @see Postcode::loadPostcode()
     *
     * @param null|string $area
     *
     * @return Postcode
     */
    protected function setArea(?string $area): Postcode
    {
        $this->area = $area;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDistrict(): ?string
    {
        return $this->district;
    }

    /**
     * Protected as for internal use only. Update this by using loadPostcode()
     *
     * @see Postcode::loadPostcode()
     *
     * @param null|string $district
     *
     * @return Postcode
     */
    protected function setDistrict(?string $district): Postcode
    {
        $this->district = $district;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getOutwardCode(): ?string
    {
        return $this->outward_code;
    }

    /**
     * Protected as for internal use only. Update this by using loadPostcode()
     *
     * @see Postcode::loadPostcode()
     *
     * @param null|string $outward_code
     *
     * @return Postcode
     */
    protected function setOutwardCode(?string $outward_code): Postcode
    {
        $this->outward_code = $outward_code;

        return $this;
    }

    /**
     * @return null|int
     */
    public function getSectorCharacter(): ?int
    {
        return $this->sector_character;
    }

    /**
     * Protected as for internal use only. Update this by using loadPostcode()
     *
     * @see Postcode::loadPostcode()
     *
     * @param null|int $sector_character
     *
     * @return Postcode
     */
    protected function setSectorCharacter(?int $sector_character): Postcode
    {
        $this->sector_character = $sector_character;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getSector(): ?string
    {
        return $this->sector;
    }

    /**
     * Protected as for internal use only. Update this by using loadPostcode()
     *
     * @see Postcode::loadPostcode()
     *
     * @param null|string $sector
     *
     * @return Postcode
     */
    protected function setSector(?string $sector): Postcode
    {
        $this->sector = $sector;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getUnit(): ?string
    {
        return $this->unit;
    }

    /**
     * Protected as for internal use only. Update this by using loadPostcode()
     *
     * @see Postcode::loadPostcode()
     *
     * @param null|string $unit
     *
     * @return Postcode
     */
    protected function setUnit(?string $unit): Postcode
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getInwardCode(): ?string
    {
        return $this->inward_code;
    }

    /**
     * Protected as for internal use only. Update this by using loadPostcode()
     *
     * @see Postcode::loadPostcode()
     *
     * @param null|string $inward_code
     *
     * @return Postcode
     */
    public function setInwardCode(?string $inward_code): Postcode
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
    public function getAreaRegex(): ?string
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

    /**
     * @return null|string
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * Protected as for internal use only. Update this by using postcodeLookup()
     *
     * @see Postcode::postcodeLookup()
     *
     * @param null|string $region
     *
     * @return Postcode
     */
    protected function setRegion(?string $region): Postcode
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * Protected as for internal use only. Update this by using postcodeLookup()
     *
     * @see Postcode::postcodeLookup()
     *
     * @param null|string $country
     *
     * @return Postcode
     */
    public function setCountry(?string $country): Postcode
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getHpiRegion(): ?string
    {
        return $this->hpi_region;
    }

    /**
     * Protected as for internal use only. Update this by using postcodeLookup()
     *
     * @see Postcode::postcodeLookup()
     *
     * @param null|string $hpi_region
     *
     * @return Postcode
     */
    public function setHpiRegion(?string $hpi_region): Postcode
    {
        $this->hpi_region = $hpi_region;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getItvRegion(): ?string
    {
        return $this->itv_region;
    }

    /**
     * Protected as for internal use only. Update this by using postcodeLookup()
     *
     * @see Postcode::postcodeLookup()
     *
     * @param null|string $itv_region
     *
     * @return Postcode
     */
    public function setItvRegion(?string $itv_region): Postcode
    {
        $this->itv_region = $itv_region;

        return $this;
    }

    // Constructor

    /**
     * Load as much as possible for quick instantiation within code:
     *
     * If only a postcode is included, it will be parsed.
     *
     * @param null|string $postcode
     * @param null|Connection $connection a DBAL connection
     */
    public function __construct(
        ?string $postcode = null,
        ?Capsule $connection = null
    ) {

        if ($postcode) {
            // automatically load the postcode
            $this->loadPostcode($postcode);
        }

        if ($connection) {
            $this->setConnection($connection->getConnection());
        }

        if ($this->checkConnection() && $this->getPostcode()) {
            // automatically load the postcode
            $this->postcodeLookup();
        }

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
            // load it in as expected
            $this->setPostcode($postcode)
                 ->setArea($this->validateArea($postcode))
                 ->setDistrict($this->validateDistrict($postcode))
                 ->setOutwardCode($this->validateOutwardCode($postcode))
                 ->setSector($this->validateSector($postcode))
                 ->setUnit($this->validateUnit($postcode))
                 ->setInwardCode($this->validateInwardCode($postcode));

            $this->status['postcode_load'] = 'Postcode loaded successfully';

            return $postcode;
        } else {
            // clear the object to stop any residual data
            $this->setPostcode($postcode)
                 ->setArea(null)
                 ->setDistrict(null)
                 ->setOutwardCode(null)
                 ->setSector(null)
                 ->setUnit(null)
                 ->setInwardCode(null);

            $this->status['postcode_load'] = 'Postcode validation failed';

            return null;
        }
    }

    /**
     * Checks that the current connection is as expected
     *
     * @return bool
     */
    public function checkConnection(): bool
    {
        if ($this->getConnection() && $this->getConnection()->getDoctrineConnection()->isConnected()) {
            // connection is active
            $this->status['db_connection'] = 'Database connection active, database not checked';

            $schemaManager = $this->getConnection()->getDoctrineConnection()->getSchemaManager();
            if (
                $schemaManager->tablesExist(['postcode_nspls']) == true
            ) {
                $this->status['db_connection'] = 'Database connection active, tables confirmed';
            }

            return true;

        } else {
            $this->status['db_connection'] = 'Database connection failed';
            return false;
        }
    }

    /**
     * Uses the specified connection and attempts to populate the remaining data from the database.
     *
     * @todo add failsafes if the table doesn't exist
     *
     * @return bool
     */
    public function postcodeLookup(): bool
    {

        if ($this->checkConnection()) {

            // Load the postcode and set all the values
            // Note we will translate the relevant ones (by joining to other tables)
            $results = $this->getConnection()->table('postcode_nspls')

                ->select(
                    'postcode_nspls.*',
                    'postcode_usertypes.usertype as usertype_verbose',
                    'postcode_osgrdinds.osgrdind as osgrdind_verbose',
                    'postcode_ceds.ced17nm as ced17nm',
                    'postcode_lauas.lad16nm as lad16nm',
                    'postcode_wards.wd17nm as wd17nm',
                    'postcode_nhsers.nhser17nm as nhser17nm'
                )

                ->leftJoin('postcode_usertypes', 'postcode_usertypes.usertype', '=', 'postcode_usertypes.id')
                ->leftJoin('postcode_osgrdinds', 'postcode_nspls.osgrdind', '=', 'postcode_osgrdinds.id')
                ->leftJoin('postcode_ceds', 'postcode_nspls.ced', '=', 'postcode_ceds.ced17cd')
                ->leftJoin('postcode_lauas', 'postcode_nspls.laua', '=', 'postcode_lauas.lad16cd')
                ->leftJoin('postcode_wards', 'postcode_nspls.ward', '=', 'postcode_wards.wd17cd')
                ->leftJoin('postcode_nhsers', 'postcode_nspls.nhser', '=', 'postcode_nhsers.nhser17cd')

                //        left join postcode_countries on postcode_nspls.ctry = postcode_countries.ctry12cd
                //       left join postcode_rgns on postcode_nspls.rgn = postcode_rgns.gor10cd
                //       left join postcode_pcons on postcode_nspls.pcon = postcode_pcons.pcon14cd
                //       left join postcode_eers on postcode_nspls.eer = postcode_rgns.gor10cd
                //       left join postcode_teclecs on postcode_nspls.teclec = postcode_teclecs.tecleccd
                //       left join postcode_ttwas on postcode_nspls.ttwa = postcode_ttwas.ttwa11cd
                //       left join postcode_nutss on postcode_nspls.nuts = postcode_nutss.lau216cd
                //       left join postcode_parks on postcode_nspls.park = postcode_parks.npark16cd
                //       left join postcode_ccgs on postcode_nspls.ccg = postcode_ccgs.ccg18cd
                //       left join postcode_bua11s on postcode_nspls.bua11 = postcode_bua11s.bua13cd
                //       left join postcode_buasd11s on postcode_nspls.buasd11 = postcode_buasd11s.buasd13cd
                //       left join postcode_ru11inds on postcode_nspls.ru11ind = postcode_ru11inds.ru11ind
                //       left join postcode_oac11s on postcode_nspls.oac11 = postcode_oac11s.oac11
                //       left join postcode_leps as leps1 on postcode_nspls.lep1 = leps1.lep17cd
                //       left join postcode_leps as leps2 on postcode_nspls.lep2 = leps2.lep17cd
                //       left join postcode_pfas on postcode_nspls.pfa = postcode_pfas.pfa15cd

                ->where('pcd', '=', $this->getPostcode())
                ->orWhere('pcd2', '=', $this->getPostcode())
                ->first();

            if(!$results) {
                $this->status['postcode_lookup'] = 'The postcode could not be found in the database';
            } else {
                $this->status['postcode_lookup'] = 'The postcode was found';

                // Manually set the properties
                foreach($results as $key => $value) {
                    $this->$key = $value;
                }
                echo $results->usertype_verbose;
            }

        } else {

            $this->setLaua(null)
                 ->setRegion(null)
                 ->setCountry(null)
                 ->setHpiRegion(null)
                 ->setItvRegion(null);

            $this->status['postcode_lookup'] = 'Postcode lookup failed';
        }

        return false;
    }


}