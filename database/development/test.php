<?php

// This is a development only file and will be removed once proper unit and acceptance testing has been made

namespace Floor9design\DatabaseTools;

use Floor9design\PostcodeTools\Postcode;

$capsule = null;
require "bootstrap.php";

echo '*** Starting basic php test ***';

$postcode = new Postcode('EC1A 1BB', $capsule,true);

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
    echo "\nVar dump of the status:\n";
    var_dump($postcode->getStatus());
}