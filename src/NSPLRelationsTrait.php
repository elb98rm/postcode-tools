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
 * @since     File available since Release 1.0
 */
trait NSPLRelationsTrait
{
    // Properties

    /**
     * Postcode user verbose
     *
     * @see ../docs/main/nspl_properties.md
     * @see $usertype
     * @var string $usertype_verbose
     */
    protected $usertype_verbose;

    /**
     * Osgrdind verbose
     *
     * @see ../docs/main/nspl_properties.md
     * @see $osgrdind
     * @var string $osgrdind_verbose
     */
    protected $osgrdind_verbose;

    /**
     * ced17nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $ced17cd
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
     * rgn_gor10nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $rgn
     * @var string $rgn_gor10nm
     */
    protected $rgn_gor10nm;

    /**
     * pcon14nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $pcon14cd
     * @var string $pcon14nm
     */
    protected $pcon14nm;

    /**
     * eer_gor10nm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $rgns
     * @var string $eer_gor10nm
     */
    protected $eer_gor10nm;

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
     * ru11inm
     *
     * @see ../docs/main/nspl_properties.md
     * @see $ru11ind
     * @var string $ru11inm
     */
    protected $ru11inm;

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

    // Accessors

    /**
     * @return int|string
     */
    public function getUsertypeVerbose(): ?string
    {
        return $this->usertype_verbose;
    }

    /**
     * @return int|string
     */
    public function getOsgrdindVerbose(): ?string
    {
        return $this->osgrdind_verbose;
    }

    /**
     * @return int|string
     */
    public function getCed17nm(): ?string
    {
        return $this->ced17nm;
    }

    /**
     * @return int|string
     */
    public function getLad17nm(): ?string
    {
        return $this->lad16nm;
    }

    /**
     * @return int|string
     */
    public function getWd17nm(): ?string
    {
        return $this->wd17nm;
    }

    /**
     * @return int|string
     */
    public function getNhser17nm(): ?string
    {
        return $this->nhser17nm;
    }

    /**
     * @return int|string
     */
    public function getCtry12nm(): ?string
    {
        return $this->ctry12nm;
    }

    /**
     * @return int|string
     */
    public function getRgnGor10nm(): ?string
    {
        return $this->rgn_gor10nm;
    }

    /**
     * @return int|string
     */
    public function getPcon14nm(): ?string
    {
        return $this->pcon14nm;
    }

    /**
     * @return int|string
     */
    public function getEerGor10nm(): ?string
    {
        return $this->eer_gor10nm;
    }

    /**
     * @return int|string
     */
    public function getTeclecnm(): ?string
    {
        return $this->teclecnm;
    }

    /**
     * @return int|string
     */
    public function getTtwa11nm(): ?string
    {
        return $this->ttwa11nm;
    }

    /**
     * @return int|string
     */
    public function getLau216nm(): ?string
    {
        return $this->lau216nm;
    }

    /**
     * @return int|string
     */
    public function getNpark16nm(): ?string
    {
        return $this->npark16nm;
    }

    /**
     * @return int|string
     */
    public function getCcg18nm(): ?string
    {
        return $this->ccg18nm;
    }

    /**
     * @return int|string
     */
    public function getBua13nm(): ?string
    {
        return $this->bua13nm;
    }

    //       left join postcode_buasd11s on postcode_nspls.buasd11 = postcode_buasd11s.buasd13cd
    //       left join postcode_ru11inds on postcode_nspls.ru11ind = postcode_ru11inds.ru11ind
    //       left join postcode_oac11s on postcode_nspls.oac11 = postcode_oac11s.oac11
    //       left join postcode_leps as leps1 on postcode_nspls.lep1 = leps1.lep17cd
    //       left join postcode_leps as leps2 on postcode_nspls.lep2 = leps2.lep17cd
    //       left join postcode_pfas on postcode_nspls.pfa = postcode_pfas.pfa15cd


}