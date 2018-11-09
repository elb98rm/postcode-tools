<?php

use PHPUnit\Framework\TestCase;
use Floor9design\PostcodeTools\NSPLFileNameTransformer;

class NSPLFileNameTransformerTest extends TestCase
{
    private $t;

    public function setUp()
    {
        $this->t = new NSPLFileNameTransformer;
    }

    public function testNonTransformerName() {
        $this->assertEquals($this->t->transform('abcdef'), 'abcdef');
    }

    public function testNSPLFile()
    {
        $this->assertEquals($this->t->transform('NSPL_AUG_2018_UK'), 'nspls');
    }

    public function testCountiesFile()
    {
        $this->assertEquals($this->t->transform('County names and codes UK as at 08_12'), 'counties');
        $this->assertEquals($this->t->transform('County names and codes UK as at 12_10'), 'counties');
    }

    public function testCEDFile()
    {
        $this->assertEquals($this->t->transform('County Electoral Division names and codes EN as at 12_17'), 'ceds');
    }

    public function testLAUAFile()
    {
        $this->assertEquals($this->t->transform('LA_UA names and codes UK as at 12_18'), 'lauas');
    }
    
    public function testWardFile()
    {
        $this->assertEquals($this->t->transform('Ward names and codes UK as at 12_18'), 'wards');

    }

    public function testHLTHAUFile()
    {
        $this->assertEquals($this->t->transform('HLTHAU names and codes UK as at 12_16'), 'hlthaus');
    }

    public function testNHSERSFile()
    {
        $this->assertEquals($this->t->transform('NHSER names and codes EN as at 04_17'), 'nhsers');
    }

    public function testCountryFile()
    {
        $this->assertEquals($this->t->transform('Country names and codes UK as at 08_12'), 'countries');
    }

    public function testRegionsFile()
    {
        $this->assertEquals($this->t->transform('Region names and codes EN as at 12_10 (GOR)'), 'rgns');
    }

    public function testPCONSFile()
    {
        $this->assertEquals($this->t->transform('Westminster Parliamentary Constituency names and codes UK as at 12_14'), 'pcons');
    }

    public function testEERSFile()
    {
        $this->assertEquals($this->t->transform('EER names and codes UK as at 12_10'), 'eers');
    }

    public function testTECLECFile()
    {
        $this->assertEquals($this->t->transform('TECLEC names and codes UK as at 12_16'), 'teclecs');
    }

    public function testTTWAFile()
    {
        $this->assertEquals($this->t->transform('TTWA names and codes UK as at 12_11 v5'), 'ttwas');
    }

    public function testPCTFile()
    {
        $this->assertEquals($this->t->transform('PCT names and codes UK as at 12_16'), 'pcts');
    }

    public function testNUTSFile()
    {
        $this->assertEquals($this->t->transform('LAU2 names and codes UK as at 12_16 (NUTS)'), 'nutss');
    }

    public function testNationalParkFile()
    {
        $this->assertEquals($this->t->transform('National Park names and codes GB as at 08_16'), 'parks');
    }

    public function testLSOAFile()
    {
        $this->assertEquals($this->t->transform('LSOA (2011) names and codes UK as at 12_12'), 'lsoa11s');
    }

    public function testMSOAFile()
    {
        $this->assertEquals($this->t->transform('MSOA (2011) names and codes UK as at 12_12'), 'msoa11s');
    }

    public function testCCGFile()
    {
        $this->assertEquals($this->t->transform('CCG names and codes UK as at 04_18'), 'ccgs');
    }

    public function testBUAFile()
    {
        $this->assertEquals($this->t->transform('BUA_names and codes UK as at 12_13'), 'bua11s');
    }

    public function testBUASDFile()
    {
        $this->assertEquals($this->t->transform('BUASD_names and codes UK as at 12_13'), 'buasd11s');
    }

    public function testRuralUrbanFile()
    {
        $this->assertEquals($this->t->transform('Rural Urban (2011) Indicator names and codes GB as at 12_16'), 'ru11inds');
    }

    public function testOACFile()
    {
        $this->assertEquals($this->t->transform('2011 Census Output Area Classification Names and Codes UK'), 'oac11s');
    }

    public function testLEPFile()
    {
        $this->assertEquals($this->t->transform('LEP names and codes EN as at 04_17 v2'), 'leps');
    }

    public function testPFAFile()
    {
        $this->assertEquals($this->t->transform('PFA names and codes GB as at 12_15'), 'pfas');
    }

    public function testIMDEnglandFile()
    {
        $this->assertEquals($this->t->transform('IMD lookup EN as at 12_15'), 'imd_ens');
    }

    public function testIMDScotlandFile()
    {
        $this->assertEquals($this->t->transform('IMD lookup SC as at 12_15'), 'imd_scs');
    }

    public function testIMDWalesFile()
    {
        $this->assertEquals($this->t->transform('IMD lookup WA as at 12_15'), 'imd_was');
    }

}