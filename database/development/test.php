<?php

// This is a development only file and will be removed once proper unit and acceptance testing has been made

namespace Floor9design\DatabaseTools;

use Floor9design\PostcodeTools\Postcode;

$capsule = null;
require "bootstrap.php";

echo '*** Starting basic php test ***';

$postcode = new Postcode('EC1A 1BB', $capsule);

echo "\nThe postcode " . $postcode->getPostcode() . ' has been loaded.';

if (!$postcode->getConnection()) {
    echo "\nThe database is not connected.";
} else {
    echo "\nThe database is connected. Here are some example properties:";
    echo "\nUsertype: " . $postcode->getUsertypeVerbose() . '(' . $postcode->getUsertype() . ')';
    echo "\nGrid reference positional quality indicator: " . $postcode->getOsgrdindVerbose() . '(' . $postcode->getOsgrdind() . ')';
    echo "\nLat: " . $postcode->getLat();
    echo "\nCountry Code: " . $postcode->getCtry();
}