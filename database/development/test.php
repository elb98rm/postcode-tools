<?php

// This is a development only file and will be removed once proper unit and acceptance testing has been made

namespace Floor9design\DatabaseTools;

use Floor9design\PostcodeTools\Postcode;
use Floor9design\PostcodeTools\PostcodeDistanceCalculator;
use Floor9design\PostcodeTools\PostcodeExporter;

$capsule = null;
require "bootstrap.php";

echo '*** Starting basic php test ***';

$postcodes = ['EC1A 1BB','PE8 4JD'];

$postcode_exporter = new PostcodeExporter();

// we're not interested in most of the output:
$postcode_exporter->setExportFields([]);
$postcode_exporter->setExtendedExportFields(['lad16nm']);
$postcode_exporter->setFurtherFields(['tv_region', 'nationwide_local_authority']);

$postcode_exporter->validateMultiplePostcodes($postcodes, $capsule, true);
$postcode_exporter->exportPostcodesToCsv('text_output.csv', true);

//$postcode = new Postcode('E6 2DH', $capsule,true);

$postcode = new Postcode('EC1A 1BB', $capsule,true);
$postcode2 = new Postcode('PE8 4JD', $capsule,true);
echo "\nThe postcode " . $postcode->getPostcode() . ' has been loaded.';


if (!$postcode->getConnection()) {
    echo "\nThe database is not connected.";
} else {
    echo "\nThe database is connected. Here are some example properties:";
    echo "\nUsertype: " . $postcode->getUsertypeVerbose() . '(' . $postcode->getUsertype() . ')';
    echo "\nGrid reference positional quality indicator: " . $postcode->getOsgrdindVerbose() . '(' . $postcode->getOsgrdind() . ')';
    echo "\nCED: " . $postcode->getCed17nm() . '(' . $postcode->getCed() . ')';
    echo "\nLaua: " . $postcode->getLad16nm() . '(' . $postcode->getLaua() . ')';
    echo "\nWard: " . $postcode->getWd17nm() . '(' . $postcode->getWard() . ')';
    echo "\nNHS Region: " . $postcode->getNhser17nm() . '(' . $postcode->getNhser() . ')';
    echo "\nOAC: " . $postcode->getOac11() . '(' . $postcode->getOac11Supergroup() . ', ' . $postcode->getOac11Group() . ', ' . $postcode->getOac11Subgroup() . ')';
    echo "\nLat: " . $postcode->getLat();
    echo "\nRegion: " . $postcode->getRgn() . '(' . $postcode->getGor10nm() . ')';
    echo "\nCountry: " . $postcode->getCtry12nm() . '(' . $postcode->getCtry() . ')';
    echo "\nTV Region: " . $postcode->findTvRegion();
    echo "\nNationwide Local Authority: " . $postcode->getNationwideLocalAuthority();
    echo "\nAlias tests: ";
    echo "\ngetPostcodeUserType: " . $postcode->getPostcodeUserType();
    echo "\ngetPositionalQualityIndicator: " . $postcode->getPositionalQualityIndicator();
    echo "\ngetCensusOutputArea: " . $postcode->getCensusOutputArea();
    echo "\ngetCounty: " . $postcode->getCounty();
    echo "\ngetCountyElectoralDivision: " . $postcode->getCountyElectoralDivision();
    echo "\ngetLocalAuthorityDistrict: " . $postcode->getLocalAuthorityDistrict();
    echo "\ngetElectoralWard: " . $postcode->getElectoralWard();
    echo "\ngetFormerStrategicHealthAuthority: " . $postcode->getFormerStrategicHealthAuthority();
    echo "\ngetNHSEnglandRegion: " . $postcode->getNHSEnglandRegion();
    echo "\ngetCountry: " . $postcode->getCountry();
    echo "\ngetRegion: " . $postcode->getRegion();
    echo "\ngetWestminsterParliamentaryConstituency: " . $postcode->getWestminsterParliamentaryConstituency();
    echo "\ngetEuropeanElectoralRegion: " . $postcode->getEuropeanElectoralRegion();
    echo "\ngetLocalLearning: " . $postcode->getLocalLearning();
    echo "\ngetTravelToWorkArea: " . $postcode->getTravelToWorkArea();
    echo "\ngetPrimaryCareTrust: " . $postcode->getPrimaryCareTrust();
    echo "\ngetLau2Area: " . $postcode->getLau2Area();
    echo "\ngetNpark16nm: " . $postcode->getNpark16nm();
    echo "\nget2011CensusLowerLayerSuperOutputArea: " . $postcode->get2011CensusLowerLayerSuperOutputArea();
    echo "\nget2011CensusMiddleLayerSuperOutputArea: " . $postcode->get2011CensusMiddleLayerSuperOutputArea();
    echo "\ngetClinicalCommisioningGroup: " . $postcode->getClinicalCommisioningGroup();
    echo "\ngetBua13nm: " . $postcode->getBua13nm();
    echo "\ngetBuasd13nm: " . $postcode->getBuasd13nm();
    echo "\nget2011CensusRuralUrbanClassification: " . $postcode->get2011CensusRuralUrbanClassification();
    echo "\nOac11 groups: " . $postcode->getOac11Subgroup() . ', ' . $postcode->getOac11Group() . ', ' . $postcode->getOac11Supergroup();
    echo "\nget2011CensusRuralUrbanClassification: " . $postcode->get2011CensusRuralUrbanClassification();
    echo "\ngetLocalEnterprisePartnershipFirst: " . $postcode->getLocalEnterprisePartnershipFirst();
    echo "\ngetLocalEnterprisePartnershipSecond: " . $postcode->getLocalEnterprisePartnershipSecond();
    echo "\ngetPoliceForceArea: " . $postcode->getPoliceForceArea();
    echo "\ngetIndexOfMultipleDeprivation: " . $postcode->getIndexOfMultipleDeprivation() . ' ' . $postcode->getImd();

    //getPoliceForceArea
    /*

    echo "\nVar dump of the status:\n";
    var_dump($postcode->getStatus());
    echo "\nNow we compare this to another location (PE8 4JD) to test to distance calculator:";

    echo "\nPostcode 1 is at : " . $postcode->getLat() . ", " . $postcode->getLong();
    echo "\nPostcode 2 is at : " . $postcode2->getLat() . ", " . $postcode2->getLong();

    $postcode_distance_calculator = new PostcodeDistanceCalculator($postcode, $postcode2, true);
    echo "\nPostcode 1 is " . $postcode_distance_calculator->getDistance() . " miles from postcode 2.";
    */
}