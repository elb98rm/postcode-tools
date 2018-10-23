<?php
/**
 * NSPLAliasesTrait.php
 *
 * NSPLAliasesTrait class
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
 * @see       ../docs/main/objects.md#NSPLAliasesTrait
 * @since     File available since Release 1.0
 *
 */

namespace Floor9design\PostcodeTools;

/**
 * Trait NSPLAliasesTrait
 *
 * A trait offering aliases for NSPL data relationships.
 * Most of these are "fudged" aliases: the NSPL relationships have specific names and references.
 *
 * For example, the useful getLocalAuthority() is an alias to the more technically correct getLad17nm()
 *
 * @category  None
 * @package   Floor9design\PostcodeTools
 * @author    Rick Morice <rick@floor9design.com>
 * @copyright Floor9design Ltd (floor9design.com)
 * @license   MIT
 * @version   1.0
 * @link      http://floor9design.com
 * @see       ../docs/main/objects.md#NSPLAliasesTrait
 * @see       NSPLTrait
 * @see       NSPLRelationsTrait
 * @since     File available since Release 1.0
 */
trait NSPLAliasesTrait
{
    // Accessors

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$usertype_verbose
     * @see Postcode::$usertype
     * @see NSPLRelationsTrait::getUsertypeVerbose()
     *
     * @return null|string
     */
    public function getPostcodeUserType(): ?string
    {
        return $this->getUsertypeVerbose();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$osgrdind_verbose
     * @see Postcode::$osgrdind
     * @see NSPLRelationsTrait::getOsgrdindVerbose()
     *
     * @return null|string
     */
    public function getPositionalQualityIndicator(): ?string
    {
        return $this->getOsgrdindVerbose();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$oa11
     * @see Postcode::$oa11
     * @see NSPLRelationsTrait::getOa11()
     * @todo waiting on the CensusOutputArea table to be joined
     * @return null|string
     */
    public function getCensusOutputArea(): ?string
    {
        return $this->getOa11();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$cty10nm
     * @see Postcode::$cty
     * @see NSPLRelationsTrait::getCty10nm()
     *
     * @return null|string
     */
    public function getCounty(): ?string
    {
        return $this->getCty10nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$ced17nm
     * @see Postcode::$ced
     * @see NSPLRelationsTrait::getCed17nm()
     *
     * @return null|string
     */
    public function getCountyElectoralDivision(): ?string
    {
        return $this->getCed17nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$lad16nm
     * @see Postcode::$laua
     * @see NSPLRelationsTrait::getLad16nm()
     *
     * @return null|string
     */
    public function getLocalAuthorityDistrict(): ?string
    {
        return $this->getLad16nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$wd17nm
     * @see Postcode::$ward
     * @see NSPLRelationsTrait::getWd17nm()
     *
     * @return null|string
     */
    public function getElectoralWard(): ?string
    {
        return $this->getWd17nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$hlthaunm
     * @see Postcode::$hlthau
     * @see NSPLRelationsTrait::getHlthaunm()
     *
     * @return null|string
     */
    public function getFormerStrategicHealthAuthority(): ?string
    {
        return $this->getHlthaunm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$nhser17nm
     * @see Postcode::$nhser
     * @see NSPLRelationsTrait::getNhser17nm()
     *
     * @return null|string
     */
    public function getNHSEnglandRegion(): ?string
    {
        return $this->getNhser17nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$ctry12nm
     * @see Postcode::$ctry
     * @see NSPLRelationsTrait::getCtry12nm()
     *
     * @return null|string
     */
    public function getCountry(): ?string
    {
        return $this->getCtry12nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$gor10nm
     * @see Postcode::$rgn
     * @see NSPLRelationsTrait::getGor10nm()
     *
     * @return null|string
     */
    public function getRegion(): ?string
    {
        return $this->getGor10nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$pcon14nm
     * @see Postcode::$pcon
     * @see NSPLRelationsTrait::getPcon14nm()
     *
     * @return null|string
     */
    public function getWestminsterParliamentaryConstituency(): ?string
    {
        return $this->getPcon14nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$eer10nm
     * @see Postcode::$eer
     * @see NSPLRelationsTrait::getEer10nm()
     *
     * @return null|string
     */
    public function getEuropeanElectoralRegion(): ?string
    {
        return $this->getEer10nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$teclecnm
     * @see Postcode::$teclec
     * @see NSPLRelationsTrait::getEer10nm()
     *
     * @return null|string
     */
    public function getLocalLearning(): ?string
    {
        return $this->getTeclecnm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$ttwa11nm
     * @see Postcode::$ttwa
     * @see NSPLRelationsTrait::getTtwa11nm()
     *
     * @return null|string
     */
    public function getTravelToWorkArea(): ?string
    {
        return $this->getTtwa11nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$pctnm
     * @see Postcode::$pct
     * @see NSPLRelationsTrait::getPctnm()
     *
     * @return null|string
     */
    public function getPrimaryCareTrust(): ?string
    {
        return $this->getPctnm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$lau216nm
     * @see Postcode::$nuts
     * @see NSPLRelationsTrait::getLau216nm()
     *
     * @return null|string
     */
    public function getLau2Area(): ?string
    {
        return $this->getLau216nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$npark16nm
     * @see Postcode::$park
     * @see NSPLRelationsTrait::getNpark16nm()
     *
     * @return null|string
     */
    public function getNationalPark(): ?string
    {
        return $this->getNpark16nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$lsoa11nm
     * @see Postcode::$lsoa11
     * @see NSPLRelationsTrait::getLsoa11nm()
     *
     * @return null|string
     */
    public function get2011CensusLowerLayerSuperOutputArea(): ?string
    {
        return $this->getLsoa11nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$msoa11nm
     * @see Postcode::$msoa11
     * @see NSPLRelationsTrait::getMsoa11nm()
     *
     * @return null|string
     */
    public function get2011CensusMiddleLayerSuperOutputArea(): ?string
    {
        return $this->getMsoa11nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$msoa11nm
     * @see Postcode::$wz11
     * @see NSPLRelationsTrait::getMsoa11nm()
     * @todo implement me
     * @return null|string
     */
    public function get2011CensusWorkplaceZone(): ?string
    {
        return null;
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$ccg18nm
     * @see Postcode::$ccg
     * @see NSPLRelationsTrait::getCcg18nm()
     *
     * @return null|string
     */
    public function getClinicalCommisioningGroup(): ?string
    {
        return $this->getCcg18nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$bua13nm
     * @see Postcode::$bua11
     * @see NSPLRelationsTrait::getBua13nm()
     *
     * @return null|string
     */
    public function getBuiltUpArea(): ?string
    {
        return $this->getBua13nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$buasd13nm
     * @see Postcode::$buasd11
     * @see NSPLRelationsTrait::getBuasd13nm()
     *
     * @return null|string
     */
    public function getBuiltUpAreaSubdivision(): ?string
    {
        return $this->getBuasd13nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$ru11nm
     * @see Postcode::$ru11ind
     * @see NSPLRelationsTrait::getRu11nm()
     *
     * @return null|string
     */
    public function get2011CensusRuralUrbanClassification(): ?string
    {
        return $this->getRu11nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$lep1_lep17nm
     * @see Postcode::$lep1
     * @see NSPLRelationsTrait::getLep1Lep17nm()
     *
     * @return null|string
     */
    public function getLocalEnterprisePartnershipFirst(): ?string
    {
        return $this->getLep1Lep17nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$lep2_lep17nm
     * @see Postcode::$lep2
     * @see NSPLRelationsTrait::getLep2Lep17nm()
     *
     * @return null|string
     */
    public function getLocalEnterprisePartnershipSecond(): ?string
    {
        return $this->getLep2Lep17nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$pfa15nm
     * @see Postcode::$pfa
     * @see NSPLRelationsTrait::getPfa15nm()
     *
     * @return null|string
     */
    public function getPoliceForceArea(): ?string
    {
        return $this->getPfa15nm();
    }

    /**
     * @see ../docs/main/nspl_aliases.md
     * @see NSPLRelationsTrait::$imd_lsoa11nm
     * @see Postcode::$imd
     * @see NSPLRelationsTrait::getImdLsoa11nm()
     *
     * @return null|string
     */
    public function getIndexOfMultipleDeprivation(): ?string
    {
        return $this->getImdLsoa11nm();
    }

}