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
use phpDocumentor\Parser\Exception;

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
    use NSPLAliasesTrait;

    // Properties

    /**
     * Statuses of the various Postcode tools/methods.
     *
     * @var array $status
     */
    protected $status = [
        'postcode_load' => 'Not attempted',
        'db_connection' => 'Not attempted',
        'postcode_lookup' => 'Not attempted',
        'errors' => []
    ];

    /**
     * @var Capsule $capsule Symfony DBAL capsule.
     */
    protected $capsule;

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
     * The inward code is the part of the postcode after the single space in the middle
     *
     * For example: "1DJ", "0EX"
     *
     * @var null|int inward_code
     */
    protected $inward_code;

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
     * Load as much as possible for quick instantiation within code:
     *
     * If only a postcode is included, it will be parsed.
     *
     * @param null|string $postcode
     * @param Capsule|null $capsule An encapsulated DBAL connection
     * @param boolean $full_load False only loads basic data, true also loads child data (with multiple DB joins)
     */
    public function __construct(
        ?string $postcode = null,
        ?Capsule $capsule = null,
        Bool $full_load = false
    ) {

        if ($postcode) {
            // automatically load the postcode
            $this->loadPostcode($postcode);
        }

        if ($capsule) {
            $this->setCapsule($capsule);
            $this->setConnection($capsule->getConnection());
        }

        if ($this->checkConnection() && $this->getPostcode()) {
            // automatically load the postcode
            $this->postcodeLookup($full_load);
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
     * Validates a postcode: returns the postcode if valid, false otherwise.
     *
     * @param string $postcode
     *
     * @return null|string
     */
    public function validatePostcode(string $postcode): ?string
    {
        // firstly, make all caps for correctness:
        $postcode = strtoupper($postcode);

        // add a space in case it's been forgotten:
        if(!strrpos($postcode, ' ')) {
            // space is always before the last three characters:
            $postcode = substr($postcode, 0, -3) . " " . substr($postcode, -3);
        }

        $matches = [];
        preg_match($this->getPostcodeRegex(), $postcode, $matches);

        if (count($matches)) {
            return $matches[0];
        } else {
            return null;
        }
    }

    /**
     * @return string
     */
    public function getPostcodeRegex(): string
    {
        return $this->postcode_regex;
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
     * @return string
     */
    public function getAreaRegex(): ?string
    {
        return $this->area_regex;
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
     * @return string
     */
    public function getDistrictRegex(): string
    {
        return $this->district_regex;
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
     * @return string
     */
    public function getOutwardCodeRegex(): string
    {
        return $this->outward_code_regex;
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
     * @return string
     */
    public function getUnitRegex(): string
    {
        return $this->unit_regex;
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
     * @return string
     */
    public function getInwardCodeRegex(): string
    {
        return $this->inward_code_regex;
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

            return true;

        } else {
            $this->status['db_connection'] = 'Database connection failed';
            return false;
        }
    }

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
     * @return null|string
     */
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    /**
     * This is protected to stop invalid postcodes being incorrectly set.
     * The function you probably want to use is: loadPostcode()
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
     * @return null|Capsule
     */
    public function getCapsule(): ?Capsule
    {
        return $this->capsule;
    }

    /**
     * @param null|Capsule $capsule
     *
     * @see Capsule
     *
     * @return Postcode
     */
    public function setCapsule(?Capsule $capsule): Postcode
    {
        $this->capsule = $capsule;

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

    // General methods

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
    protected function getSectorRegex(): string
    {
        return $this->sector_regex;
    }

    /**
     * Uses the specified connection and attempts to populate the remaining data from the database.
     *
     * @todo add failsafes if the table doesn't exist
     *
     * @param $full_load
     * @return bool
     */
    protected function postcodeLookup($full_load): bool
    {
        if ($this->checkConnection()) {

            $results = null;

            if ($full_load) {
                try {
                    // check that one of the child tables is available
                    if ($this->tableExists('postcode_nspls') && $this->tableExists('postcode_ceds')) {
                        // Load the postcode and set all the values including children
                        $results = $this->getConnection()->table('postcode_nspls')
                            ->select(
                                'postcode_nspls.*',
                                'postcode_usertypes.usertype as usertype_verbose',
                                'postcode_osgrdinds.osgrdind as osgrdind_verbose',
                                'postcode_counties.cty10nm as cty10nm',
                                'postcode_ceds.ced17nm as ced17nm',
                                'postcode_lauas.lad16nm as lad16nm',
                                'postcode_wards.wd17nm as wd17nm',
                                'postcode_hlthaus.hlthaunm as hlthaunm',
                                'postcode_nhsers.nhser17nm as nhser17nm',
                                'postcode_countries.ctry12nm as ctry12nm',
                                'postcode_rgns.gor10nm as gor10nm',
                                'postcode_pcons.pcon14nm as pcon14nm',
                                'postcode_eers.eer10nm as eer10nm',
                                'postcode_teclecs.teclecnm as teclecnm',
                                'postcode_ttwas.ttwa11nm as ttwa11nm',
                                'postcode_pcts.pctnm as pctnm',
                                'postcode_nutss.lau216nm as lau216nm',
                                'postcode_parks.npark16nm as npark16nm',
                                'postcode_lsoa11s.lsoa11nm as lsoa11nm',
                                'postcode_msoa11s.msoa11nm as msoa11nm',
                                'postcode_ccgs.ccg18nm as ccg18nm',
                                'postcode_bua11s.bua13nm as bua13nm',
                                'postcode_buasd11s.buasd13nm as buasd13nm',
                                'postcode_ru11inds.ru11nm as ru11nm',
                                'postcode_oac11s.supergroup as oac11_supergroup',
                                'postcode_oac11s.group as oac11_group',
                                'postcode_oac11s.subgroup as oac11_subgroup',
                                'leps1.lep17nm as lep1_lep17nm',
                                'leps2.lep17nm as lep2_lep17nm',
                                'postcode_pfas.pfa15nm as pfa15nm',
                                'postcode_imds.lsoa11nm as imd_lsoa11nm'
                            )
                            ->leftJoin('postcode_usertypes', 'postcode_nspls.usertype', '=', 'postcode_usertypes.id')
                            ->leftJoin('postcode_osgrdinds', 'postcode_nspls.osgrdind', '=', 'postcode_osgrdinds.id')
                            ->leftJoin('postcode_counties', 'postcode_nspls.cty', '=', 'postcode_counties.cty10cd')
                            ->leftJoin('postcode_ceds', 'postcode_nspls.ced', '=', 'postcode_ceds.ced17cd')
                            ->leftJoin('postcode_lauas', 'postcode_nspls.laua', '=', 'postcode_lauas.lad16cd')
                            ->leftJoin('postcode_wards', 'postcode_nspls.ward', '=', 'postcode_wards.wd17cd')
                            ->leftJoin('postcode_hlthaus', 'postcode_nspls.hlthau', '=', 'postcode_hlthaus.hlthaucd')
                            ->leftJoin('postcode_nhsers', 'postcode_nspls.nhser', '=', 'postcode_nhsers.nhser17cd')
                            ->leftJoin('postcode_countries', 'postcode_nspls.ctry', '=', 'postcode_countries.ctry12cd')
                            ->leftJoin('postcode_rgns', 'postcode_nspls.rgn', '=', 'postcode_rgns.gor10cd')
                            ->leftJoin('postcode_pcons', 'postcode_nspls.pcon', '=', 'postcode_pcons.pcon14cd')
                            ->leftJoin('postcode_eers', 'postcode_nspls.eer', '=', 'postcode_eers.eer10cd')
                            ->leftJoin('postcode_teclecs', 'postcode_nspls.teclec', '=', 'postcode_teclecs.tecleccd')
                            ->leftJoin('postcode_ttwas', 'postcode_nspls.ttwa', '=', 'postcode_ttwas.ttwa11cd')
                            ->leftJoin('postcode_pcts', 'postcode_nspls.pct', '=', 'postcode_pcts.pctcd')
                            ->leftJoin('postcode_nutss', 'postcode_nspls.nuts', '=', 'postcode_nutss.lau216cd')
                            ->leftJoin('postcode_parks', 'postcode_nspls.park', '=', 'postcode_parks.npark16cd')
                            ->leftJoin('postcode_lsoa11s', 'postcode_nspls.lsoa11', '=', 'postcode_lsoa11s.lsoa11cd')
                            ->leftJoin('postcode_msoa11s', 'postcode_nspls.msoa11', '=', 'postcode_msoa11s.msoa11cd')
                            ->leftJoin('postcode_ccgs', 'postcode_nspls.ccg', '=', 'postcode_ccgs.ccg18cd')
                            ->leftJoin('postcode_bua11s', 'postcode_nspls.bua11', '=', 'postcode_bua11s.bua13cd')
                            ->leftJoin('postcode_buasd11s', 'postcode_nspls.buasd11', '=', 'postcode_buasd11s.buasd13cd')
                            ->leftJoin('postcode_ru11inds', 'postcode_nspls.ru11ind', '=', 'postcode_ru11inds.ru11ind')
                            ->leftJoin('postcode_oac11s', 'postcode_nspls.oac11', '=', 'postcode_oac11s.oac11')
                            ->leftJoin('postcode_leps as leps1', 'postcode_nspls.lep1', '=', 'leps1.lep17cd')
                            ->leftJoin('postcode_leps as leps2', 'postcode_nspls.lep2', '=', 'leps2.lep17cd')
                            ->leftJoin('postcode_pfas', 'postcode_nspls.pfa', '=', 'postcode_pfas.pfa15cd')
                            ->leftJoin('postcode_imds', 'postcode_nspls.imd', '=', 'postcode_imds.imd15')
                            ->where('pcd', '=', $this->getPostcode())
                            ->orWhere('pcd2', '=', $this->getPostcode())
                            ->orWhere('pcds', '=', $this->getPostcode())
                            ->first();
                    } else {
                        throw new Exception("Some of the postcode tables do not exist. It's likely that these haven't been set up.");
                    }
                } catch (Exception $e) {
                    $this->status['errors'][] = $e->getMessage();
                }
            } else {
                try {
                    if ($this->tableExists('postcode_nspls')) {
                        // Load the postcode and set all the values
                        $results = $this->getConnection()->table('postcode_nspls')
                            ->select(
                                'postcode_nspls.*'
                            )
                            ->where('pcd', '=', $this->getPostcode())
                            ->orWhere('pcd2', '=', $this->getPostcode())
                            ->first();
                    } else {
                        throw new Exception("The postcode_nspls table does not exist. It's likely that this hasn't been set up.");
                    }
                } catch (Exception $e) {
                    $this->status['errors'][] = $e->getMessage();
                }
            }

            if (!$results) {
                $this->status['postcode_lookup'] = 'The postcode could not be found in the database';
            } else {
                $this->status['postcode_lookup'] = 'The postcode was found';

                // NSPL properties
                foreach ($results as $key => $value) {
                    $this->$key = $value;
                }
            }

        } else {
            $this->status['postcode_lookup'] = 'Postcode lookup failed';
        }

        return false;
    }

    /**
     * Returns true if the specified table exists in the database.
     *
     * @param $table
     *
     * @return bool
     */
    protected function tableExists($table): bool
    {
        if ($this->getCapsule()->schema()->hasTable($table)) {
            return true;
        }
        return false;
    }

}