<?php
/**
 * PostcodeDistanceCalculator.php
 *
 * Class to allow approximate distance calculation from a postcode outcode
 *
 * php 7+
 *
 * @category  None
 * @package   Floor9design\PostcodeDistanceCalculator
 * @author    Rick Morice <rick@floor9design.com>
 * @copyright floor9design.com
 * @license   GPL 3.0 (http://www.gnu.org/copyleft/gpl.html)
 * @version   0.1
 * @link      http://floor9design.com/
 * @see       http://floor9design.com/
 * @since     File available since Release 1.0
 */

namespace Floor9design\PostcodeTools;

/**
 * Class PostcodeDistanceCalculator
 *
 * Class to allow approximate distance calculation from a postcodes
 * These are calculated using postcode lat/long data, and assume a perfectly spherical earth.
 * Results are thus inaccurate, but a good indication and are useful enough for an average map search.
 *
 * Internal functions are public to allow custom/combination calculations.
 * Properties are protected to ensure proper accessor interaction.
 *
 * @category  None
 * @package   Floor9design\PostcodeDistanceCalculator
 * @author    Rick Morice <rick@floor9design.com>
 * @copyright floor9design.com
 * @license   GPL 3.0 (http://www.gnu.org/copyleft/gpl.html)
 * @version   0.1
 * @link      http://floor9design.com/
 * @see       http://floor9design.com/
 * @since     File available since Release 1.0
 */
class PostcodeDistanceCalculator
{
    /**
     * @var bool $imperial Imperial marker. If true, distances will be given in miles.
     */
    protected $imperial = false;

    /**
     * @var Postcode $first_postcode First postcode
     */
    protected $first_postcode;

    /**
     * @var Postcode $second_postcode Second postcode
     */
    protected $second_postcode;

    /**
     * @var float $distance Calculated distance between items
     */
    protected $distance;

    // Accessors

    /**
     * PostcodeDistanceCalculator constructor.
     * Most likely instantiation is with postcodes, so allow easy set.
     * If they're set, automatically do the calculation on them.
     *
     * @param Postcode $first_postcode
     * @param Postcode $second_postcode
     * @param bool $imperial Are the measurements converted to imperial (miles)
     */
    function __construct(
        Postcode $first_postcode = null,
        Postcode $second_postcode = null,
        bool $imperial = false
    ) {
        $this->setFirstPostcode($first_postcode)
            ->setSecondPostcode($second_postcode)
            ->setImperial($imperial);

        // If everything is set up and called correctly, simply provide the answer straight away
        if (
            $this->getFirstPostcode() &&
            $this->getSecondPostcode()
        ) {
            $this->calculatePostcodeDistance($this->getFirstPostcode(), $this->getSecondPostcode());
        }
    }

    /**
     * Get the imperial marker
     *
     * @return bool
     */
    public function getImperial(): bool
    {
        return $this->imperial;
    }

    /**
     * Set the imperial marker
     *
     * @param bool $imperial Imperial selector
     *
     * @return PostcodeDistanceCalculator
     */
    protected function setImperial(bool $imperial): PostcodeDistanceCalculator
    {
        $this->imperial = $imperial;

        return $this;
    }

    /**
     * Get the first postcode
     *
     * @return Postcode
     */
    public function getFirstPostcode(): Postcode
    {
        return $this->first_postcode;
    }

    /**
     * Set the first postcode
     *
     * @param Postcode $first_postcode First postcode
     *
     * @return PostcodeDistanceCalculator
     */
    public function setFirstPostcode(Postcode $first_postcode): PostcodeDistanceCalculator
    {
        $this->first_postcode = $first_postcode;

        return $this;
    }

    /**
     * Get the second postcode
     *
     * @return Postcode
     */
    public function getSecondPostcode(): Postcode
    {
        return $this->second_postcode;
    }

    /**
     * Set the second postcode
     *
     * @param Postcode $second_postcode Second postcode
     *
     * @return PostcodeDistanceCalculator
     */
    public function setSecondPostcode(Postcode $second_postcode): PostcodeDistanceCalculator
    {
        $this->second_postcode = $second_postcode;

        return $this;
    }

    /**
     * Get the distance
     *
     * @return float
     */
    public function getDistance(): float
    {
        return $this->distance;
    }

    /**
     * Set the distance
     *
     * @param float $distance Second latitude
     *
     * @return PostcodeDistanceCalculator
     */
    protected function setDistance(float $distance): PostcodeDistanceCalculator
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Calculate approximate distance between two geo-locations on the surface of the planet.
     *
     * @param float $lat1 Latitude of first item
     * @param float $lon1 Longitude of first item
     * @param float $lat2 Latitude of second item
     * @param float $lon2 Longitude of second item
     *
     * @return float distance
     */
    public function calculateGeoLocationDistance(
        float $lat1,
        float $lon1,
        float $lat2,
        float $lon2
    ): float {
        // assumes spherical earth
        $pi80 = M_PI / 180;
        $lat1 *= $pi80;
        $lon1 *= $pi80;
        $lat2 *= $pi80;
        $lon2 *= $pi80;

        $r = 6372.797; // mean radius of Earth in km
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $r * $c;

        // we work in miles in the UK:
        if ($this->imperial) {
            $distance = $distance * 0.621371;
        }

        return ceil($distance);
    }

    // Main functions

    /**
     * Calculates the distance between two postcodes.
     * Returns distance, also sets result $this->distance
     *
     * @param Postcode $first_postcode First postcode
     * @param Postcode $second_postcode Second postcode
     *
     * @return float Distance between postcodes
     */
    public function calculatePostcodeDistance(Postcode $first_postcode, Postcode $second_postcode): float
    {
        $this->setDistance(
            $this->calculateGeoLocationDistance(
                $first_postcode->getLat(),
                $first_postcode->getLong(),
                $second_postcode->getLat(),
                $second_postcode->getLong()
            )
        );

        return $this->getDistance();
    }

}