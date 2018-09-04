<?php
/**
 * NSPLTrait.php
 *
 * NSPLTrait class
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
 * @see       ../docs/main/objects.md#NSPLTrait
 * @since     File available since Release 1.0
 *
 */

namespace Floor9design\PostcodeTools;

/**
 * Trait NSPLTrait
 *
 * A trait offering properties and get accessors for NSPL data.
 *
 * @category  None
 * @package   Floor9design\PostcodeTools
 * @author    Rick Morice <rick@floor9design.com>
 * @copyright Floor9design Ltd (floor9design.com)
 * @license   MIT
 * @version   1.0
 * @link      http://floor9design.com
 * @see       ../docs/main/objects.md#NSPLTrait
 * @since     File available since Release 1.0
 */
trait NSPLTrait
{
    // Properties

    /**
     * Unit postcode – 7 character version
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $pcd
     */
    protected $pcd;

    /**
     * Unit postcode – 8 character version
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $pcd2
     */
    protected $pcd2;

    /**
     * Unit postcode - variable length (e-Gif) version
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $pcds
     */
    protected $pcds;

    /**
     * Date of introduction
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $dointr
     */
    protected $dointr;

    /**
     * Date of termination
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $doterm
     */
    protected $doterm;

    /**
     * Postcode user
     *
     * @see ../docs/main/nspl_properties.md
     * @var bool $usertype
     */
    protected $usertype;

    /**
     * National grid reference - Easting
     *
     * @see ../docs/main/nspl_properties.md
     * @var float $oseast1m
     */
    protected $oseast1m;

    /**
     * National grid reference - Northing
     *
     * @see ../docs/main/nspl_properties.md
     * @var float $osnrth1m
     */
    protected $osnrth1m;

    /**
     * Grid reference positional quality indicator
     *
     * @see ../docs/main/nspl_properties.md
     * @var float $osgrdind
     */
    protected $osgrdind;

    /**
     * 2011 Census Output Area (OA) / Small Area (SA)
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $oa11
     */
    protected $oa11;

    /**
     * County
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $cty
     */
    protected $cty;

    /**
     * County Electoral Division
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $ced
     */
    protected $ced;

    /**
     * Local Authority District (LAD)/unitary authority (UA)/ metropolitan district (MD)/ London borough (LB)/ council
     * area (CA)/district council area (DCA)
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $laua
     */
    protected $laua;

    /**
     * (Electoral) ward/division
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $laua
     */
    protected $ward;

    /**
     * Former Strategic Health Authority (SHA)/ Local Health Board (LHB)/ Health Board (HB)/ Health Authority (HA)/
     * Health & Social Care Board (HSCB)
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $hlthau
     */
    protected $hlthau;

    /**
     * Former Strategic Health Authority (SHA)/ Local Health Board (LHB)/ Health Board (HB)/ Health Authority (HA)/
     * Health & Social Care Board (HSCB)
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $hlthau
     */
    protected $nhser;

    /**
     * Country
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $ctry
     */
    protected $ctry;

    /**
     * Region (former GOR)
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $rgn
     */
    protected $rgn;

    /**
     * Westminster parliamentary constituency
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $pcon
     */
    protected $pcon;

    /**
     * European Electoral Region (EER)
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $eer
     */
    protected $eer;

    /**
     * Local Learning and Skills Council (LLSC)/ Dept. of Children, Education, Lifelong Learning and Skills
     * (DCELLS)/Enterprise Region (ER)
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $teclec
     */
    protected $teclec;

    /**
     * Travel to Work Area (TTWA)
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $ttwa
     */
    protected $ttwa;

    /**
     * Primary Care Trust (PCT)/ Care Trust/ Care Trust Plus (CT)/ Local Health Board (LHB)/ Community Health
     * Partnership (CHP)/ Local Commissioning Group (LCG)/ Primary Healthcare Directorate (PHD)
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $pct
     */
    protected $pct;

    /**
     * LAU2 area
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $nuts
     */
    protected $nuts;

    /**
     * National park
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $park
     */
    protected $park;

    /**
     * 2011 Census Lower Layer Super Output Area (LSOA)/ Data Zone (DZ)/ SOA
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $lsoa11
     */
    protected $lsoa11;

    /**
     * Middle Layer Super Output Area (MSOA)/ Intermediate Zone (IZ)
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $msoa11
     */
    protected $msoa11;

    /**
     * 2011 Census Workplace Zone
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $wz11
     */
    protected $wz11;

    /**
     * Clinical Commissioning Group (CCG)/ Local Health Board (LHB)/ Community Health Partnership (CHP)/ Local
     * Commissioning Group (LCG)/ Primary Healthcare Directorate (PHD)
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $ccg
     */
    protected $ccg;

    /**
     * Built-up Area (BUA)
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $bua11
     */
    protected $bua11;

    /**
     * Built-up Area Sub-division (BUASD)
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $buasd11
     */
    protected $buasd11;

    /**
     * 2011 Census rural-urban classification
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $ru11ind
     */
    protected $ru11ind;

    /**
     * 2011 Census Output Area classification (OAC)
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $oac11
     */
    protected $oac11;

    /**
     * Decimal degrees latitude
     *
     * @see ../docs/main/nspl_properties.md
     * @var float $lat
     */
    protected $lat;

    /**
     * Decimal degrees longitude
     *
     * @see ../docs/main/nspl_properties.md
     * @var float $long
     */
    protected $long;

    /**
     * Local Enterprise Partnership (LEP) - first instance
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $lep1
     */
    protected $lep1;

    /**
     * Local Enterprise Partnership (LEP) – second instance
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $lep2
     */
    protected $lep2;

    /**
     * Police Force Area (PFA)
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $pfa
     */
    protected $pfa;

    /**
     * Index of Multiple Deprivation (IMD)
     *
     * @see ../docs/main/nspl_properties.md
     * @var int $imd
     */
    protected $imd;

    /**
     * Cancer Alliances and the National Cancer Vanguard
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $imd
     */
    protected $calncv;

    /**
     * Sustainability and Transformation Partnerships
     *
     * @see ../docs/main/nspl_properties.md
     * @var string $imd
     */
    protected $stp;

    // Accessors

    /**
     * @return string|null
     */
    public function getPcd(): ?string
    {
        return $this->pcd;
    }

    /**
     * @return string|null
     */
    public function getPcd2(): ?string
    {
        return $this->pcd2;
    }

    /**
     * @return string|null
     */
    public function getPcds(): ?string
    {
        return $this->pcds;
    }

    /**
     * @return string|null
     */
    public function getDointr(): ?string
    {
        return $this->dointr;
    }

    /**
     * @return string|null
     */
    public function getDoterm(): ?string
    {
        return $this->doterm;
    }

    /**
     * @return bool|null
     */
    public function getUsertype(): ?bool
    {
        return $this->usertype;
    }

    /**
     * @return float|null
     */
    public function getOseast1m(): ?float
    {
        return $this->oseast1m;
    }

    /**
     * @return float|null
     */
    public function getOsnrth1m(): ?float
    {
        return $this->osnrth1m;
    }

    /**
     * @return int|null
     */
    public function getOsgrdind(): ?int
    {
        return $this->osgrdind;
    }

    /**
     * @return string|null
     */
    public function getOal1(): ?string
    {
        return $this->oa11;
    }

    /**
     * @return string|null
     */
    public function getCty(): ?string
    {
        return $this->cty;
    }

    /**
     * @return string|null
     */
    public function getCed(): ?string
    {
        return $this->ced;
    }

    /**
     * @return string|null
     */
    public function getLaua(): ?string
    {
        return $this->laua;
    }

    /**
     * @return string|null
     */
    public function getWard(): ?string
    {
        return $this->ward;
    }

    /**
     * @return string|null
     */
    public function getHlthau(): ?string
    {
        return $this->hlthau;
    }

    /**
     * @return string|null
     */
    public function getNhser(): ?string
    {
        return $this->nhser;
    }

    /**
     * @return string|null
     */
    public function getCtry(): ?string
    {
        return $this->ctry;
    }

    /**
     * @return string|null
     */
    public function getRgn(): ?string
    {
        return $this->rgn;
    }

    /**
     * @return string|null
     */
    public function getPcon(): ?string
    {
        return $this->pcon;
    }

    /**
     * @return string|null
     */
    public function getEer(): ?string
    {
        return $this->eer;
    }

    /**
     * @return string|null
     */
    public function getTeclec(): ?string
    {
        return $this->teclec;
    }

    /**
     * @return string|null
     */
    public function getTtwa(): ?string
    {
        return $this->ttwa;
    }

    /**
     * @return string|null
     */
    public function getPct(): ?string
    {
        return $this->pct;
    }

    /**
     * @return string|null
     */
    public function getNuts(): ?string
    {
        return $this->nuts;
    }

    /**
     * @return string|null
     */
    public function getPark(): ?string
    {
        return $this->park;
    }

    /**
     * @return string|null
     */
    public function getLsoa11(): ?string
    {
        return $this->lsoa11;
    }

    /**
     * @return string|null
     */
    public function getMsoa11(): ?string
    {
        return $this->msoa11;
    }

    /**
     * @return string|null
     */
    public function getWz11(): ?string
    {
        return $this->wz11;
    }

    /**
     * @return string|null
     */
    public function getCcg(): ?string
    {
        return $this->ccg;
    }

    /**
     * @return string|null
     */
    public function getBua11(): ?string
    {
        return $this->bua11;
    }

    /**
     * @return string|null
     */
    public function getBuasd11(): ?string
    {
        return $this->buasd11;
    }

    /**
     * @return string|null
     */
    public function getRu11ind(): ?string
    {
        return $this->ru11ind;
    }

    /**
     * @return string|null
     */
    public function getOac11(): ?string
    {
        return $this->oac11;
    }

    /**
     * @return float|null
     */
    public function getLat(): ?float
    {
        return $this->lat;
    }

    /**
     * @return float|null
     */
    public function getLong(): ?float
    {
        return $this->long;
    }

    /**
     * @return string|null
     */
    public function getLep1(): ?string
    {
        return $this->lep1;
    }

    /**
     * @return string|null
     */
    public function getLep2(): ?string
    {
        return $this->lep2;
    }

    /**
     * @return string|null
     */
    public function getPfa(): ?string
    {
        return $this->pfa;
    }

    /**
     * @return int|null
     */
    public function getImd(): ?int
    {
        return $this->imd;
    }

    /**
     * @return int|string
     */
    public function getCalncv(): ?string
    {
        return $this->calncv;
    }

    /**
     * @return int|string
     */
    public function getStp(): ?string
    {
        return $this->stp;
    }

}