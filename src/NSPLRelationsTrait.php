<?php
/**
 * NSPLRelationsTrait.php
 *
 * NSPLRelationsTrait class
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
 * @see       ../docs/main/objects.md#NSPLRelationsTrait
 * @since     File available since Release 1.0
 *
 */

namespace Floor9design\PostcodeTools;

/**
 * Trait NSPLRelationsTrait
 *
 * A trait offering properties and get accessors for NSPL data relationships.
 * For example:
 * usertype -> 0 maps to: usertype_verbose -> small user
 *
 * @category  None
 * @package   Floor9design\PostcodeTools
 * @author    Rick Morice <rick@floor9design.com>
 * @copyright Floor9design Ltd (floor9design.com)
 * @license   MIT
 * @version   1.0
 * @link      http://floor9design.com
 * @see       ../docs/main/objects.md#NSPLRelationsTrait
 * @see       NSPLAliasesTrait
 * @since     File available since Release 1.0
 */
trait NSPLRelationsTrait
{
    // Properties

    /**
     * Postcode user verbose
     *
     * @see ../docs/main/nspl_properties.md
     * @see Postcode::$usertype
     * @see NSPLAliasesTrait::getPostcodeUserType()
     *
     * @var string $usertype_verbose
     */
    protected $usertype_verbose;

    /**
     * osgrdind_verbose
     *
     * @see ../docs/main/nspl_properties.md
     * @see Postcode::$osgrdind
     * @see NSPLAliasesTrait::getPositionalQualityIndicator()
     *
     * @var string $osgrdind_verbose
     */
    protected $osgrdind_verbose;

    /**
     * cty10nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $cty10cd
     * @var string $cty10nm
     */
    protected $cty10nm;

    /**
     * ced17nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $ced17cd
     * @see
     *
     * @var string $ced17nm
     */
    protected $ced17nm;

    /**
     * lad16nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $lad16cd
     * @var string $lad16nm
     */
    protected $lad16nm;

    /**
     * wd17nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $wd17cd
     * @var string $wd17nm
     */
    protected $wd17nm;

    /**
     * hlthaunm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $hlthau
     * @var string $hlthaunm
     */
    protected $hlthaunm;

    /**
     * wd17nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $nhser17cd
     * @var string $nhser17nm
     */
    protected $nhser17nm;

    /**
     * ctry12nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $ctry12cd
     * @var string $ctry12nm
     */
    protected $ctry12nm;

    /**
     * gor10nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $rgn
     * @var string $gor10nm
     */
    protected $gor10nm;

    /**
     * pcon14nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $pcon14cd
     * @var string $pcon14nm
     */
    protected $pcon14nm;

    /**
     * eer10nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $eers
     * @var string $eer10nm
     */
    protected $eer10nm;

    /**
     * teclecnm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $tecleccd
     * @var string $teclecnm
     */
    protected $teclecnm;

    /**
     * ttwa11nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $ttwa
     * @var string $ttwa11nm
     */
    protected $ttwa11nm;

    /**
     * pctnm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $pct
     * @var string $pctnm
     */
    protected $pctnm;

    /**
     * lau216nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $nuts
     * @var string $lau216cd
     */
    protected $lau216nm;

    /**
     * npark16nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $park
     * @var string $npark16nm
     */
    protected $npark16nm;

    /**
     * lsoa11nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $lsoa11
     * @var string $lsoa11nm
     */
    protected $lsoa11nm;

    /**
     * msoa11nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $msoa11
     * @var string $msoa11nm
     */
    protected $msoa11nm;

    /**
     * ccg18nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $ccg
     * @var string $ccg18nm
     */
    protected $ccg18nm;

    /**
     * bua13nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $bua11
     * @var string $bua13nm
     */
    protected $bua13nm;

    /**
     * buasd13nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $buasd13cd
     * @var string $buasd13nm
     */
    protected $buasd13nm;

    /**
     * ru11inm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $ru11ind
     * @var string $ru11nm
     */
    protected $ru11nm;

    /**
     * oac11_supergroup
     *
     * @see ../docs/main/nspl_properties.md
     * @see $oac11
     * @var string $oac11_supergroup
     */
    protected $oac11_supergroup;

    /**
     * oac11_group
     *
     * @see ../docs/main/nspl_properties.md
     * @see $oac11
     * @var string $oac11_group
     */
    protected $oac11_group;

    /**
     * oac11_subgroup
     *
     * @see ../docs/main/nspl_properties.md
     * @see $oac11
     * @var string $oac11_subgroup
     */
    protected $oac11_subgroup;

    /**
     * lep1_lep17nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $lep1
     * @var string $lep1_lep17nm
     */
    protected $lep1_lep17nm;

    /**
     * lep2_lep17nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $lep2
     * @var string $lep2_lep17nm
     */
    protected $lep2_lep17nm;

    /**
     * pfa15nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $pfa15cd
     * @var string $pfa15nm
     */
    protected $pfa15nm;

    /**
     * imd_lsoa11nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $imd_lsoa11nm
     * @var string $imd_lsoa11nm
     */
    protected $imd_lsoa11nm;

    // Accessors

    /**
     * @return null|string
     */
    public function getUsertypeVerbose(): ?string
    {
        return $this->usertype_verbose;
    }

    /**
     * @return null|string
     */
    public function getOsgrdindVerbose(): ?string
    {
        return $this->osgrdind_verbose;
    }

    /**
     * @return null|string
     */
    public function getCed17nm(): ?string
    {
        return $this->ced17nm;
    }

    /**
     * @return null|string
     */
    public function getCty10nm(): ?string
    {
        return $this->cty10nm;
    }

    /**
     * @return null|string
     */
    public function getLad16nm(): ?string
    {
        return $this->lad16nm;
    }

    /**
     * @return null|string
     */
    public function getWd17nm(): ?string
    {
        return $this->wd17nm;
    }

    /**
     * @return null|string
     */
    public function getHlthaunm(): ?string
    {
        return $this->hlthaunm;
    }

    /**
     * @return null|string
     */
    public function getNhser17nm(): ?string
    {
        return $this->nhser17nm;
    }

    /**
     * @return null|string
     */
    public function getCtry12nm(): ?string
    {
        return $this->ctry12nm;
    }

    /**
     * @return null|string
     */
    public function getGor10nm(): ?string
    {
        return $this->gor10nm;
    }

    /**
     * @return null|string
     */
    public function getPcon14nm(): ?string
    {
        return $this->pcon14nm;
    }

    /**
     * @return null|string
     */
    public function getEer10nm(): ?string
    {
        return $this->eer10nm;
    }

    /**
     * @return null|string
     */
    public function getTeclecnm(): ?string
    {
        return $this->teclecnm;
    }

    /**
     * @return null|string
     */
    public function getTtwa11nm(): ?string
    {
        return $this->ttwa11nm;
    }

    /**
     * @return null|string
     */
    public function getPctnm(): ?string
    {
        return $this->pctnm;
    }

    /**
     * @return null|string
     */
    public function getLau216nm(): ?string
    {
        return $this->lau216nm;
    }

    /**
     * @return null|string
     */
    public function getNpark16nm(): ?string
    {
        return $this->npark16nm;
    }

    /**
     * @return null|string
     */
    public function getLsoa11nm(): ?string
    {
        return $this->lsoa11nm;
    }

    /**
     * @return null|string
     */
    public function getMsoa11nm(): ?string
    {
        return $this->msoa11nm;
    }

    /**
     * @return null|string
     */
    public function getCcg18nm(): ?string
    {
        return $this->ccg18nm;
    }

    /**
     * @return null|string
     */
    public function getBua13nm(): ?string
    {
        return $this->bua13nm;
    }

    /**
     * @return null|string
     */
    public function getBuasd13nm(): ?string
    {
        return $this->buasd13nm;
    }

    /**
     * @return null|string
     */
    public function getRu11nm(): ?string
    {
        return $this->ru11nm;
    }

    /**
     * @return null|string
     */
    public function getOac11Supergroup(): ?string
    {
        return $this->oac11_supergroup;
    }

    /**
     * @return null|string
     */
    public function getOac11Group(): ?string
    {
        return $this->oac11_group;
    }

    /**
     * @return null|string
     */
    public function getOac11Subgroup(): ?string
    {
        return $this->oac11_subgroup;
    }

    /**
     * @return null|string
     */
    public function getLep1Lep17nm(): ?string
    {
        return $this->lep1_lep17nm;
    }

    /**
     * @return null|string
     */
    public function getLep2Lep17nm(): ?string
    {
        return $this->lep2_lep17nm;
    }

    /**
     * @return null|string
     */
    public function getPfa15nm(): ?string
    {
        return $this->pfa15nm;

    }

    /**
     * @return null|string
     */
    public function getImdLsoa11nm(): ?string
    {
        return $this->imd_lsoa11nm;

    }

}