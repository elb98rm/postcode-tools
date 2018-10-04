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

$valid_postcodes = $postcode_exporter->validateMultiplePostcodes($postcodes, $capsule, true);

$postcode_exporter->exportPostcodesToCsv($valid_postcodes, 'text_output.csv', true);

$postcode = new Postcode('EC1A 1BB', $capsule,true);
$postcode = new Postcode('PE8 4JD', $capsule,true);
echo "\nThe postcode " . $postcode->getPostcode() . ' has been loaded.';


if (!$postcode->getConnection()) {
    echo "\nThe database is not connected.";
} else {
    echo "\nThe database is connected. Here are some example properties:";
    echo "\nUsertype: " . $postcode->getUsertypeVerbose() . '(' . $postcode->getUsertype() . ')';
    echo "\nGrid reference positional quality indicator: " . $postcode->getOsgrdindVerbose() . '(' . $postcode->getOsgrdind() . ')';
    echo "\nCED: " . $postcode->getCed17nm() . '(' . $postcode->getCed() . ')';
    echo "\nLaua: " . $postcode->getLad17nm() . '(' . $postcode->getLaua() . ')';
    echo "\nWard: " . $postcode->getWd17nm() . '(' . $postcode->getWard() . ')';
    echo "\nNHS Region: " . $postcode->getNhser17nm() . '(' . $postcode->getNhser() . ')';
    echo "\nOAC: " . $postcode->getOac11() . '(' . $postcode->getOac11Supergroup() . ', ' . $postcode->getOac11Group() . ', ' . $postcode->getOac11Subgroup() . ')';
    echo "\nLat: " . $postcode->getLat();
    echo "\nCountry: " . $postcode->getCtry12nm() . '(' . $postcode->getCtry() . ')';
    echo "\nTV Region: " . $postcode->findTvRegion();
    echo "\nVar dump of the status:\n";
    var_dump($postcode->getStatus());
    echo "\nNow we compare this to another location (W1A 0AX) to test to distance calculator:";


    //$postcode2 = new Postcode('W1A 0AX', $capsule);
    $postcode2 = new Postcode('S10 1UY', $capsule);

    echo "\nPostcode 1 is at : " . $postcode->getLat() . ", " . $postcode->getLong();
    echo "\nPostcode 2 is at : " . $postcode2->getLat() . ", " . $postcode2->getLong();

    $postcode_distance_calculator = new PostcodeDistanceCalculator($postcode, $postcode2, true);
    echo "\nPostcode 1 is " . $postcode_distance_calculator->getDistance() . " miles from postcode 2.";

}