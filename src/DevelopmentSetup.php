<?php
/**
 * DevelopmentSetup.php
 *
 * DevelopmentSetup class
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
 * @see       ../docs/main/objects.md#DevelopmentSetup
 * @since     File available since Release 1.0
 *
 */

namespace Floor9design\PostcodeTools;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class DevelopmentSetup
 *
 * A class that offering tools to set up the database structure and import the data
 *
 * @category  None
 * @package   Floor9design\PostcodeTools
 * @author    Rick Morice <rick@floor9design.com>
 * @copyright Floor9design Ltd (floor9design.com)
 * @license   MIT
 * @version   1.0
 * @link      http://floor9design.com
 * @see       ../docs/main/objects.md#DevelopmentSetup
 * @since     File available since Release 1.0
 */
class DevelopmentSetup implements SetupInterface
{

    /**
     * Set up the whole database
     *
     * @return bool
     */
    public function setupAll(): bool
    {
        $this->createPostcodeNspls();
        $this->createUsertypes();
        $this->createOsgrdinds();
        //$this->createOa11();
        $this->createCounties();
        $this->createCeds();
        $this->createLauas();
        $this->createWards();
        $this->createHlthaus();
        $this->createNhsers();
        $this->createCountries();
        $this->createRgns();
        $this->createPcons();
        $this->createEers();
        $this->createTeclecs();
        $this->createTtwas();
        $this->createPcts();
        $this->createNutss();
        $this->createParks();
        $this->createLsoa11s();
        $this->createWz11s();
        $this->createCcgs();
        $this->createBua11s();
        $this->createBuasd11();
        $this->createRu11ind();
        $this->createOac11();
        $this->createLeps();
        $this->createPfas();
        $this->createImds();

        return true;
    }

    /**
     * Sets up and populates the postcode_nspls table
     *
     * @return bool
     */
    public function createPostcodeNspls(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_nspls');

        // set up the database
        Capsule::schema()->create('postcode_nspls', function (Blueprint $table) {
            $table->string('pcd', 8)->primary();
            $table->string('pcd2', 8);
            $table->string('pcds', 8);
            $table->string('dointr', 6);
            $table->string('doterm', 6)->nullable();
            $table->boolean('usertype')->nullable();
            $table->float('oseast1m', 10)->nullable();
            $table->float('osnrth1m', 10)->nullable();
            $table->integer('osgrdind');
            $table->string('oa11')->nullable();
            $table->string('cty')->nullable();
            $table->string('ced')->nullable();
            $table->string('laua')->nullable();
            $table->string('ward')->nullable();
            $table->string('hlthau')->nullable();
            $table->string('nhser')->nullable();
            $table->string('ctry')->nullable();
            $table->string('rgn')->nullable();
            $table->string('pcon')->nullable();
            $table->string('eer')->nullable();
            $table->string('teclec')->nullable();
            $table->string('ttwa')->nullable();
            $table->string('pct')->nullable();
            $table->string('nuts')->nullable();
            $table->string('park')->nullable();
            $table->string('lsoa11')->nullable();
            $table->string('msoa11')->nullable();
            $table->string('wz11')->nullable();
            $table->string('ccg')->nullable();
            $table->string('bua11')->nullable();
            $table->string('buasd11')->nullable();
            $table->string('ru11ind')->nullable();
            $table->string('oac11')->nullable();
            $table->float('lat');
            $table->float('long');
            $table->string('lep1')->nullable();
            $table->string('lep2')->nullable();
            $table->string('pfa')->nullable();
            $table->integer('imd');
            $table->string('calncv')->nullable();
            $table->string('stp')->nullable();
        });

        // import the existing data
        if (($handle = fopen('../source/nspls.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "pcd") {

                    // set empty strings as null
                    foreach ($data as $record => $datum) {

                        if ($datum == '') {
                            $data[$record] = null;
                        }
                    }

                    // instantiate
                    $nspl = new NSPL($data);

                    // populate
                    $nspl->save();

                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_nspls')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_usertypes table
     *
     * @return bool
     */
    public function createUsertypes(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_usertypes');

        // set up the database
        Capsule::schema()->create('postcode_usertypes', function (Blueprint $table) {
            $table->boolean('id');
            $table->string('usertype');
        });

        // No need to import such a simple table:
        DB::table('postcode_usertypes')->insert(
            [
                'id' => 0,
                'usertype' => 'small user'
            ]
        );

        DB::table('postcode_usertypes')->insert(
            [
                'id' => 1,
                'usertype' => 'large user'
            ]
        );

        if (Capsule::schema()->hasTable('postcode_usertypes')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_osgrdinds table
     *
     * @return bool
     */
    public function createOsgrdinds(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_osgrdinds');

        // set up the database
        Capsule::schema()->create('postcode_osgrdinds', function (Blueprint $table) {
            $table->integer('id');
            $table->string('osgrdind');
        });

        // No need to import such a simple table:
        DB::table('postcode_osgrdinds')->insert(
            [
                'id' => 1,
                'osgrdind' => 'within the building of the matched address closest to the postcode mean'
            ]
        );

        DB::table('postcode_osgrdinds')->insert(
            [
                'id' => 2,
                'osgrdind' => 'as for status value 1, except by visual inspection of Landline maps (Scotland only)'
            ]
        );

        DB::table('postcode_osgrdinds')->insert(
            [
                'id' => 3,
                'osgrdind' => 'approximate to within 50 metres'
            ]
        );

        DB::table('postcode_osgrdinds')->insert(
            [
                'id' => 4,
                'osgrdind' => 'postcode unit mean (mean of matched addresses with the same postcode, but not snapped to a building)'
            ]
        );

        DB::table('postcode_osgrdinds')->insert(
            [
                'id' => 5,
                'osgrdind' => 'imputed by ONS, by reference to surrounding postcode grid references'
            ]
        );

        DB::table('postcode_osgrdinds')->insert(
            [
                'id' => 6,
                'osgrdind' => 'postcode sector mean, (mainly PO Boxes)'
            ]
        );

        DB::table('postcode_osgrdinds')->insert(
            [
                'id' => 8,
                'osgrdind' => 'postcode terminated prior to Gridlink initiative, last known ONS postcode grid reference2'
            ]
        );

        DB::table('postcode_osgrdinds')->insert(
            [
                'id' => 9,
                'osgrdind' => 'no grid reference available'
            ]
        );

        if (Capsule::schema()->hasTable('postcode_osgrdinds')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_oal1s table
     * @todo fix me : dont know what the table is!
     * @return bool
     */
    public function createOal1s(): bool
    {
        /*
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_oal1s');

        // set up the database
        Capsule::schema()->create('postcode_oal1s', function (Blueprint $table) {
            $table->string('oac11')->primary();
            $table->string('supergroup');
            $table->string('group');
            $table->string('subgroup');
        });

        // import the existing data
        if (($handle = fopen('../source/oal1s.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "OAC11") {

                    // No need to import such a simple table:
                    DB::table('postcode_oal1s')->insert(
                        [
                            'oac11' => $data[0],
                            'supergroup' => $data[1],
                            'group' => $data[2],
                            'subgroup' => $data[3]
                        ]
                    );

                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_oal1s')) {
            return true;
        } else {
            return false;
        }
        */
    }

    /**
     * Sets up and populates the postcode_counties table
     *
     * @return bool
     */
    public function createCounties(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_counties');

        // set up the database
        Capsule::schema()->create('postcode_counties', function (Blueprint $table) {
            $table->string('cty10cd')->primary();
            $table->string('cty10nm');
            $table->string('unused_field')->nullable();
        });

        // import the existing data
        if (($handle = fopen('../source/counties.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "CTY10CD" && $data[1] != "CTY10NM") {

                    // No need to import such a simple table:
                    DB::table('postcode_counties')->insert(
                        [
                            'cty10cd' => $data[0],
                            'cty10nm' => $data[1],
                            'unused_field' => $data[2]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_counties')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_ceds table
     *
     * @return bool
     */
    public function createCeds(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_ceds');

        // set up the database
        Capsule::schema()->create('postcode_ceds', function (Blueprint $table) {
            $table->string('ced17cd')->primary();
            $table->string('ced17nm');
        });

        // import the existing data
        if (($handle = fopen('../source/ceds.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "CED17CD" && $data[1] != "CED17NM") {

                    // No need to import such a simple table:
                    DB::table('postcode_ceds')->insert(
                        [
                            'ced17cd' => $data[0],
                            'ced17nm' => $data[1]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        // this table also has exceptions that are not included:
        DB::table('postcode_ceds')->insert(
            [
                'ced17cd' => 'E99999999',
                'ced17nm' => 'England'
            ]
        );

        DB::table('postcode_ceds')->insert(
            [
                'ced17cd' => 'W99999999',
                'ced17nm' => 'Wales'
            ]
        );

        DB::table('postcode_ceds')->insert(
            [
                'ced17cd' => 'S99999999',
                'ced17nm' => 'Scotland'
            ]
        );

        DB::table('postcode_ceds')->insert(
            [
                'ced17cd' => 'N99999999',
                'ced17nm' => 'Northern Ireland'
            ]
        );

        DB::table('postcode_ceds')->insert(
            [
                'ced17cd' => 'L99999999',
                'ced17nm' => 'Channel Islands'
            ]
        );

        DB::table('postcode_ceds')->insert(
            [
                'ced17cd' => 'M99999999',
                'ced17nm' => 'Isle of Man'
            ]
        );

        if (Capsule::schema()->hasTable('postcode_ceds')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_lauas table
     *
     * @return bool
     */
    public function createLauas(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_lauas');

        // set up the database
        Capsule::schema()->create('postcode_lauas', function (Blueprint $table) {
            $table->string('lad16cd')->primary();
            $table->string('lad16nm');
        });

        // import the existing data
        if (($handle = fopen('../source/lauas.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "LAD16CD" && $data[1] != "LAD16NM") {

                    // No need to import such a simple table:
                    DB::table('postcode_lauas')->insert(
                        [
                            'lad16cd' => $data[0],
                            'lad16nm' => $data[1]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        // this table also has exceptions that are not included:
        DB::table('postcode_lauas')->insert(
            [
                'lad16cd' => 'L99999999',
                'lad16nm' => 'Channel Islands'
            ]
        );

        // this table also has exceptions that are not included:
        DB::table('postcode_lauas')->insert(
            [
                'lad16cd' => 'M99999999',
                'lad16nm' => 'Isle of Man'
            ]
        );

        if (Capsule::schema()->hasTable('postcode_lauas')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_wards table
     *
     * @return bool
     */
    public function createWards(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_wards');

        // set up the database
        Capsule::schema()->create('postcode_wards', function (Blueprint $table) {
            $table->string('wd17cd')->primary();
            $table->string('wd17nm');
            $table->string('unused_field')->nullable();
        });

        // import the existing data
        if (($handle = fopen('../source/wards.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "WD17CD" && $data[1] != "WD17NM") {

                    // Insert data
                    DB::table('postcode_wards')->insert(
                        [
                            'wd17cd' => $data[0],
                            'wd17nm' => $data[1]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        // this table also has exceptions that are not included:
        DB::table('postcode_wards')->insert(
            [
                'wd17cd' => 'L99999999',
                'wd17nm' => 'Channel Islands'
            ]
        );

        DB::table('postcode_wards')->insert(
            [
                'wd17cd' => 'M99999999',
                'wd17nm' => 'Isle of Man'
            ]
        );

        if (Capsule::schema()->hasTable('postcode_wards')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_hlthaus table
     *
     * @return bool
     */
    public function createHlthaus(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_hlthaus');

        // set up the database
        Capsule::schema()->create('postcode_hlthaus', function (Blueprint $table) {
            $table->string('hlthaucd')->primary();
            $table->string('hlthaucdo')->nullable();
            $table->string('hlthaunm')->nullable();
            $table->string('hlthaunmw')->nullable();
        });

        // import the existing data
        if (($handle = fopen('../source/hlthaus.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "HLTHAUCD" && $data[1] != "HLTHAUCDO") {

                    // Insert data
                    DB::table('postcode_hlthaus')->insert(
                        [
                            'hlthaucd' => $data[0],
                            'hlthaucdo' => $data[1],
                            'hlthaunm' => $data[2],
                            'hlthaunmw' => $data[3]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_hlthaus')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_nhsers table
     *
     * @return bool
     */
    public function createNhsers(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_nhsers');

        // set up the database
        Capsule::schema()->create('postcode_nhsers', function (Blueprint $table) {
            $table->string('nhser17cd')->primary();
            $table->string('nhser17cdh')->nullable();
            $table->string('nhser17nm');
        });

        // import the existing data
        if (($handle = fopen('../source/nhsers.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "NHSER17CD" && $data[1] != "NHSER17CDH") {

                    // Insert data
                    DB::table('postcode_nhsers')->insert(
                        [
                            'nhser17cd' => $data[0],
                            'nhser17cdh' => $data[1],
                            'nhser17nm' => $data[2]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        // this table also has exceptions that are not included:
        DB::table('postcode_nhsers')->insert(
            [
                'nhser17cd' => 'W99999999',
                'nhser17nm' => 'Wales'
            ]
        );

        DB::table('postcode_nhsers')->insert(
            [
                'nhser17cd' => 'S99999999',
                'nhser17nm' => 'Scotland'
            ]
        );

        DB::table('postcode_nhsers')->insert(
            [
                'nhser17cd' => 'N99999999',
                'nhser17nm' => 'Northern Ireland'
            ]
        );

        DB::table('postcode_nhsers')->insert(
            [
                'nhser17cd' => 'L99999999',
                'nhser17nm' => 'Channel Islands'
            ]
        );

        DB::table('postcode_nhsers')->insert(
            [
                'nhser17cd' => 'M99999999',
                'nhser17nm' => 'Isle of Man'
            ]
        );

        if (Capsule::schema()->hasTable('postcode_nhsers')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_countries table
     *
     * @return bool
     */
    public function createCountries(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_countries');

        // set up the database
        Capsule::schema()->create('postcode_countries', function (Blueprint $table) {
            $table->string('ctry12cd')->primary();
            $table->string('ctry12cdo');
            $table->string('ctry12nm');
            $table->string('ctry12nmw')->nullable();
        });

        // import the existing data
        if (($handle = fopen('../source/countries.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "CTRY12CD" && $data[1] != "CTRY12CDO") {

                    // No need to import such a simple table:
                    DB::table('postcode_countries')->insert(
                        [
                            'ctry12cd' => $data[0],
                            'ctry12cdo' => $data[1],
                            'ctry12nm' => $data[2],
                            'ctry12nmw' => $data[3]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_countries')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_rgns table
     *
     * @return bool
     */
    public function createRgns(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_rgns');

        // set up the database
        Capsule::schema()->create('postcode_rgns', function (Blueprint $table) {
            $table->string('gor10cd')->primary();
            $table->string('gor10cdo')->nullable();
            $table->string('gor10nm');
            $table->string('gor10nmw')->nullable();
        });

        // import the existing data
        if (($handle = fopen('../source/rgns.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "GOR10CD" && $data[1] != "GOR10CDO") {

                    // No need to import such a simple table:
                    DB::table('postcode_rgns')->insert(
                        [
                            'gor10cd' => $data[0],
                            'gor10cdo' => $data[1],
                            'gor10nm' => $data[2],
                            'gor10nmw' => $data[3]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_rgns')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_pcons table
     *
     * @return bool
     */
    public function createPcons(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_pcons');

        // set up the database
        Capsule::schema()->create('postcode_pcons', function (Blueprint $table) {
            $table->string('pcon14cd')->primary();
            $table->string('pcon14nm');
        });

        // import the existing data
        if (($handle = fopen('../source/pcons.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "PCON14CD" && $data[1] != "PCON14NM") {

                    // No need to import such a simple table:
                    DB::table('postcode_pcons')->insert(
                        [
                            'pcon14cd' => $data[0],
                            'pcon14nm' => $data[1]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        // this table also has exceptions that are not included:
        DB::table('postcode_pcons')->insert(
            [
                'pcon14cd' => 'W99999999',
                'pcon14nm' => 'Wales'
            ]
        );

        DB::table('postcode_pcons')->insert(
            [
                'pcon14cd' => 'S99999999',
                'pcon14nm' => 'Scotland'
            ]
        );

        if (Capsule::schema()->hasTable('postcode_pcons')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_eers table
     *
     * @return bool
     */
    public function createEers(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_eers');

        // set up the database
        Capsule::schema()->create('postcode_eers', function (Blueprint $table) {
            $table->string('eer10cd')->primary();
            $table->string('eer10cdo')->nullable();
            $table->string('eer10nm');
        });

        // import the existing data
        if (($handle = fopen('../source/eers.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "EER10CD" && $data[1] != "EER10CDO") {

                    // No need to import such a simple table:
                    DB::table('postcode_eers')->insert(
                        [
                            'eer10cd' => $data[0],
                            'eer10cdo' => $data[1],
                            'eer10nm' => $data[2]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_eers')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_teclecs table
     *
     * @return bool
     */
    public function createTeclecs(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_teclecs');

        // set up the database
        Capsule::schema()->create('postcode_teclecs', function (Blueprint $table) {
            $table->string('tecleccd')->primary();
            $table->string('tecleccdo')->nullable();
            $table->string('teclecnm');
        });

        // import the existing data
        if (($handle = fopen('../source/teclecs.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "TECLECCD" && $data[1] != "TECLECCDO") {

                    // No need to import such a simple table:
                    DB::table('postcode_teclecs')->insert(
                        [
                            'tecleccd' => $data[0],
                            'tecleccdo' => $data[1],
                            'teclecnm' => $data[2]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_teclecs')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_ttwas table
     *
     * @return bool
     */
    public function createTtwas(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_ttwas');

        // set up the database
        Capsule::schema()->create('postcode_ttwas', function (Blueprint $table) {
            $table->string('ttwa11cd')->primary();
            $table->string('ttwa11nm');
        });

        // import the existing data
        if (($handle = fopen('../source/ttwas.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "TTWA11CD" && $data[1] != "TTWA11NM") {

                    // No need to import such a simple table:
                    DB::table('postcode_ttwas')->insert(
                        [
                            'ttwa11cd' => $data[0],
                            'ttwa11nm' => $data[1]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_ttwas')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_pcts table
     *
     * @return bool
     */
    public function createPcts(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_pcts');

        // set up the database
        Capsule::schema()->create('postcode_pcts', function (Blueprint $table) {
            $table->string('pctcd')->primary();
            $table->string('pctcdo')->nullable();
            $table->string('pctnm');
            $table->string('pctnmw')->nullable();
        });

        // import the existing data
        if (($handle = fopen('../source/pcts.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "PCTCD" && $data[1] != "PCTCDO") {

                    // No need to import such a simple table:
                    DB::table('postcode_pcts')->insert(
                        [
                            'pctcd' => $data[0],
                            'pctcdo' => $data[1],
                            'pctnm' => $data[2],
                            'pctnmw' => $data[3]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_pcts')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_nutss table
     *
     * @return bool
     */
    public function createNutss(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_nutss');

        // set up the database
        Capsule::schema()->create('postcode_nutss', function (Blueprint $table) {
            $table->string('lau216cd')->primary();
            $table->string('lau216nm');
        });

        // import the existing data
        if (($handle = fopen('../source/nutss.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "LAU216CD" && $data[1] != "LAU216NM") {

                    // No need to import such a simple table:
                    DB::table('postcode_nutss')->insert(
                        [
                            'lau216cd' => $data[0],
                            'lau216nm' => $data[1]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_nutss')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_parks table
     *
     * @return bool
     */
    public function createParks(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_parks');

        // set up the database
        Capsule::schema()->create('postcode_parks', function (Blueprint $table) {
            $table->string('npark16cd')->primary();
            $table->string('npark16nm');
        });

        // import the existing data
        if (($handle = fopen('../source/parks.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "NPARK16CD" && $data[1] != "NPARK16NM") {

                    // No need to import such a simple table:
                    DB::table('postcode_parks')->insert(
                        [
                            'npark16cd' => $data[0],
                            'npark16nm' => $data[1]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_parks')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_lsoa11s table
     *
     * @return bool
     */
    public function createLsoa11s(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_lsoa11s');

        // set up the database
        Capsule::schema()->create('postcode_lsoa11s', function (Blueprint $table) {
            $table->string('lsoa11cd')->primary();
            $table->string('lsoa11nm');
        });

        // import the existing data
        if (($handle = fopen('../source/lsoa11s.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "LSOA11CD" && $data[1] != "LSOA11NM") {

                    // No need to import such a simple table:
                    DB::table('postcode_lsoa11s')->insert(
                        [
                            'lsoa11cd' => $data[0],
                            'lsoa11nm' => $data[1]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_lsoa11s')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_ccgs table
     *
     * @return bool
     */
    public function createCcgs(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_ccgs');

        // set up the database
        Capsule::schema()->create('postcode_ccgs', function (Blueprint $table) {
            $table->string('ccg18cd')->primary();
            $table->string('ccg18cdh');
            $table->string('ccg18nm');
            $table->string('ccg18nmw');
        });

        // import the existing data
        if (($handle = fopen('../source/ccgs.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "CCG18CD" && $data[1] != "CCG18CDH") {

                    // No need to import such a simple table:
                    DB::table('postcode_ccgs')->insert(
                        [
                            'ccg18cd' => $data[0],
                            'ccg18cdh' => $data[1],
                            'ccg18nm' => $data[2],
                            'ccg18nmw' => $data[3]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_ccgs')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_wz11s table
     * @todo fix me : dont know what the table is!
     *
     * @return bool
     */
    public function createWz11s(): bool
    {
        /*
         * @todo find out what table this relates to
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_wz11s');

        // set up the database
        Capsule::schema()->create('postcode_wz11s', function (Blueprint $table) {
            $table->string('lsoa11cd')->primary();
            $table->string('lsoa11nm');
        });

        // import the existing data
        if (($handle = fopen('../source/wz11s.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "LSOA11CD" && $data[1] != "LSOA11NM") {

                    // No need to import such a simple table:
                    DB::table('postcode_wz11s')->insert(
                        [
                            'lsoa11cd' => $data[0],
                            'lsoa11nm' => $data[1]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_wz11s')) {
            return true;
        } else {
            return false;
        }
        */
    }

    /**
     * Sets up and populates the postcode_bua11s table
     *
     * @return bool
     */
    public function createBua11s(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_bua11s');

        // set up the database
        Capsule::schema()->create('postcode_bua11s', function (Blueprint $table) {
            $table->string('bua13cd')->primary();
            $table->string('bua13nm');
        });

        // import the existing data
        if (($handle = fopen('../source/bua11s.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "BUA13CD" && $data[1] != "BUA13NM") {

                    // No need to import such a simple table:
                    DB::table('postcode_bua11s')->insert(
                        [
                            'bua13cd' => $data[0],
                            'bua13nm' => $data[1]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_bua11s')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_buasd11s table
     *
     * @return bool
     */
    public function createBuasd11(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_buasd11s');

        // set up the database
        Capsule::schema()->create('postcode_buasd11s', function (Blueprint $table) {
            $table->string('buasd13cd')->primary();
            $table->string('buasd13nm');
        });

        // import the existing data
        if (($handle = fopen('../source/buasd11s.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "BUASD13CD" && $data[1] != "BUASD13NM") {

                    // No need to import such a simple table:
                    DB::table('postcode_buasd11s')->insert(
                        [
                            'buasd13cd' => $data[0],
                            'buasd13nm' => $data[1]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_buasd11s')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_ru11inds table
     *
     * @return bool
     */
    public function createRu11ind(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_ru11inds');

        // set up the database
        Capsule::schema()->create('postcode_ru11inds', function (Blueprint $table) {
            $table->string('ru11ind')->primary();
            $table->string('ru11nm');
        });

        // import the existing data
        if (($handle = fopen('../source/ru11inds.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "RU11IND" && $data[1] != "RU11NM") {

                    // No need to import such a simple table:
                    DB::table('postcode_ru11inds')->insert(
                        [
                            'ru11ind' => $data[0],
                            'ru11nm' => $data[1]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_ru11inds')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_oac11s table
     *
     * @return bool
     */
    public function createOac11(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_oac11s');

        // set up the database
        Capsule::schema()->create('postcode_oac11s', function (Blueprint $table) {
            $table->string('oac11')->primary();
            $table->string('supergroup');
            $table->string('group');
            $table->string('subgroup');
        });

        // import the existing data
        if (($handle = fopen('../source/oac11s.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "OAC11" && $data[1] != "Supergroup") {

                    // No need to import such a simple table:
                    DB::table('postcode_oac11s')->insert(
                        [
                            'oac11' => $data[0],
                            'supergroup' => $data[1],
                            'group' => $data[2],
                            'subgroup' => $data[3]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_oac11s')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_leps table
     *
     * @return bool
     */
    public function createLeps(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_leps');

        // set up the database
        Capsule::schema()->create('postcode_leps', function (Blueprint $table) {
            $table->string('lep17cd')->primary();
            $table->string('lep17nm');
        });

        // import the existing data
        if (($handle = fopen('../source/leps.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "LEP17CD" && $data[1] != "LEP17NM") {

                    // No need to import such a simple table:
                    DB::table('postcode_leps')->insert(
                        [
                            'lep17cd' => $data[0],
                            'lep17nm' => $data[1]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_leps')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_pfas table
     *
     * @return bool
     */
    public function createPfas(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_pfas');

        // set up the database
        Capsule::schema()->create('postcode_pfas', function (Blueprint $table) {
            $table->string('pfa15cd')->primary();
            $table->string('pfa15nm');
        });

        // import the existing data
        if (($handle = fopen('../source/pfas.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // skip the headers:
                if ($data[0] != "PFA15CD" && $data[1] != "PFA15NM") {

                    // No need to import such a simple table:
                    DB::table('postcode_pfas')->insert(
                        [
                            'pfa15cd' => $data[0],
                            'pfa15nm' => $data[1]
                        ]
                    );
                }
            }
            fclose($handle);
        }

        if (Capsule::schema()->hasTable('postcode_pfas')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets up and populates the postcode_imds table
     *
     * @return bool
     */
    public function createImds(): bool
    {
        // drop pre-existing setups
        Capsule::schema()->dropIfExists('postcode_imds');

        // set up the database
        Capsule::schema()->create('postcode_imds', function (Blueprint $table) {
            $table->string('lsoa11cd')->primary();
            $table->string('lsoa11nm');
            $table->string('imd15')->nullable();
        });

        // import the existing data
        $tables = ['imd_ens', 'imd_scs', 'imd_was'];

        foreach ($tables as $table) {
            if (($handle = fopen('../source/' . $table . '.csv', 'r')) !== false) {
                while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                    // skip the headers:
                    if ($data[0] != "LSOA11CD" && $data[1] != "LSOA11NM") {

                        // No need to import such a simple table:
                        DB::table('postcode_imds')->insert(
                            [
                                'lsoa11cd' => $data[0],
                                'lsoa11nm' => $data[1],
                                'imd15' => $data[2] ?? 0
                            ]
                        );
                    }
                }
                fclose($handle);
            }
        }

        if (Capsule::schema()->hasTable('postcode_imds')) {
            return true;
        } else {
            return false;
        }
    }


}