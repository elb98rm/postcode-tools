<?php
/**
 * NSPL.php
 *
 * NSPL class
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
 * @see       ../docs/main/objects.md#NSPL
 * @since     File available since Release 1.0
 *
 */

namespace Floor9design\PostcodeTools;

use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class NSPL
 *
 * A class interact with the NSPL data, namely to convert it into a database table
 *
 * @category  None
 * @package   Floor9design\PostcodeTools
 * @author    Rick Morice <rick@floor9design.com>
 * @copyright Floor9design Ltd (floor9design.com)
 * @license   MIT
 * @version   1.0
 * @link      http://floor9design.com
 * @see       ../docs/main/objects.md#NSPL
 * @since     File available since Release 1.0
 */
class NSPL
{
    use NSPLTrait;

    // Accessors

    /**
     * Uses data array for quick instantiation within code
     *
     * @param null|string $data
     * @param null|string $dbal
     */
    public function __construct(
        ?array $data = null
    ) {
        if ($data) {
            // automatically load the postcode
            $this->setPcd($data[0])
                ->setPcd2($data[1])
                ->setPcds($data[2])
                ->setDointr($data[3])
                ->setDoterm($data[4])
                ->setUsertype($data[5])
                ->setOseast1m($data[6])
                ->setOsnrth1m($data[7])
                ->setOsgrdind($data[8])
                ->setOa11($data[9])
                ->setCty($data[10])
                ->setCed($data[11])
                ->setLaua($data[12])
                ->setWard($data[13])
                ->setHlthau($data[14])
                ->setNhser($data[15])
                ->setCtry($data[16])
                ->setRgn($data[17])
                ->setPcon($data[18])
                ->setEer($data[19])
                ->setTeclec($data[20])
                ->setTtwa($data[21])
                ->setPct($data[22])
                ->setNuts($data[23])
                ->setPark($data[24])
                ->setLsoa11($data[25])
                ->setMsoa11($data[26])
                ->setWz11($data[27])
                ->setCcg($data[28])
                ->setBua11($data[29])
                ->setBuasd11($data[30])
                ->setRu11ind($data[31])
                ->setOac11($data[32])
                ->setLat($data[33])
                ->setLong($data[34])
                ->setLep1($data[35])
                ->setLep2($data[36])
                ->setPfa($data[37])
                ->setImd($data[38])
                ->setCalncv($data[39])
                ->setStp($data[40]);
        }
    }

    /**
     * @param string|null $stp
     * @return NSPL
     */
    public function setStp(?string $stp): NSPL
    {
        $this->stp = $stp;

        return $this;
    }

    /**
     * @param string|null $calncv
     * @return NSPL
     */
    public function setCalncv(?string $calncv): NSPL
    {
        $this->calncv = $calncv;

        return $this;
    }

    /**
     * @param int|null $imd
     * @return NSPL
     */
    public function setImd(?int $imd): NSPL
    {
        $this->imd = $imd;

        return $this;
    }

    /**
     * @param string|null $pfa
     * @return NSPL
     */
    public function setPfa(?string $pfa): NSPL
    {
        $this->pfa = $pfa;

        return $this;
    }

    /**
     * @param string|null $lep2
     * @return NSPL
     */
    public function setLep2(?string $lep2): NSPL
    {
        $this->lep2 = $lep2;

        return $this;
    }

    /**
     * @param string|null $lep1
     * @return NSPL
     */
    public function setLep1(?string $lep1): NSPL
    {
        $this->lep1 = $lep1;

        return $this;
    }

    /**
     * @param float|null $long
     * @return NSPL
     */
    public function setLong(?float $long): NSPL
    {
        $this->long = $long;

        return $this;
    }

    /**
     * @param float|null $lat
     * @return NSPL
     */
    public function setLat(?float $lat): NSPL
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * @param string|null $oac11
     * @return NSPL
     */
    public function setOac11(?string $oac11): NSPL
    {
        $this->oac11 = $oac11;

        return $this;
    }

    /**
     * @param string|null $ru11ind
     * @return NSPL
     */
    public function setRu11ind(?string $ru11ind): NSPL
    {
        $this->ru11ind = $ru11ind;

        return $this;
    }

    /**
     * @param string|null $buasd11
     * @return NSPL
     */
    public function setBuasd11(?string $buasd11): NSPL
    {
        $this->buasd11 = $buasd11;

        return $this;
    }

    /**
     * @param string|null $bua11
     * @return NSPL
     */
    public function setBua11(?string $bua11): NSPL
    {
        $this->bua11 = $bua11;

        return $this;
    }

    /**
     * @param string|null $ccg
     * @return NSPL
     */
    public function setCcg(?string $ccg): NSPL
    {
        $this->ccg = $ccg;

        return $this;
    }

    /**
     * @param string|null $wz11
     * @return NSPL
     */
    public function setWz11(?string $wz11): NSPL
    {
        $this->wz11 = $wz11;

        return $this;
    }

    /**
     * @param string|null $msoa11
     * @return NSPL
     */
    public function setMsoa11(?string $msoa11): NSPL
    {
        $this->msoa11 = $msoa11;

        return $this;
    }

    /**
     * @param string|null $lsoa11
     * @return NSPL
     */
    public function setLsoa11(?string $lsoa11): NSPL
    {
        $this->lsoa11 = $lsoa11;

        return $this;
    }

    /**
     * @param string|null $park
     * @return NSPL
     */
    public function setPark(?string $park): NSPL
    {
        $this->park = $park;

        return $this;
    }

    /**
     * @param string|null $nuts
     * @return NSPL
     */
    public function setNuts(?string $nuts): NSPL
    {
        $this->nuts = $nuts;

        return $this;
    }

    /**
     * @param string|null $pct
     * @return NSPL
     */
    public function setPct(?string $pct): NSPL
    {
        $this->pct = $pct;

        return $this;
    }

    /**
     * @param string|null $ttwa
     * @return NSPL
     */
    public function setTtwa(?string $ttwa): NSPL
    {
        $this->ttwa = $ttwa;

        return $this;
    }

    /**
     * @param string|null $teclec
     * @return NSPL
     */
    public function setTeclec(?string $teclec): NSPL
    {
        $this->teclec = $teclec;

        return $this;
    }

    /**
     * @param string|null $eer
     * @return NSPL
     */
    public function setEer(?string $eer): NSPL
    {
        $this->eer = $eer;

        return $this;
    }

    /**
     * @param string|null $pcon
     * @return NSPL
     */
    public function setPcon(?string $pcon): NSPL
    {
        $this->pcon = $pcon;

        return $this;
    }

    /**
     * @param string|null $rgn
     * @return NSPL
     */
    public function setRgn(?string $rgn): NSPL
    {
        $this->rgn = $rgn;

        return $this;
    }

    /**
     * @param string|null $ctry
     * @return NSPL
     */
    public function setCtry(?string $ctry): NSPL
    {
        $this->ctry = $ctry;

        return $this;
    }

    /**
     * @param string|null $nhser
     * @return NSPL
     */
    public function setNhser(?string $nhser): NSPL
    {
        $this->nhser = $nhser;

        return $this;
    }

    /**
     * @param string|null $hlthau
     * @return NSPL
     */
    public function setHlthau(?string $hlthau): NSPL
    {
        $this->hlthau = $hlthau;

        return $this;
    }

    /**
     * @param string|null $ward
     * @return NSPL
     */
    public function setWard(?string $ward): NSPL
    {
        $this->ward = $ward;

        return $this;
    }

    /**
     * @param string|null $laua
     * @return NSPL
     */
    public function setLaua(?string $laua): NSPL
    {
        $this->laua = $laua;

        return $this;
    }

    /**
     * @param string|null $ced
     * @return NSPL
     */
    public function setCed(?string $ced): NSPL
    {
        $this->ced = $ced;

        return $this;
    }

    /**
     * @param string|null $cty
     * @return NSPL
     */
    public function setCty(?string $cty): NSPL
    {
        $this->cty = $cty;

        return $this;
    }

    /**
     * @param string|null $oall
     * @return NSPL
     */
    public function setOa11(?string $oa11): NSPL
    {
        $this->oa11 = $oa11;

        return $this;
    }

    /**
     * @param int|null $osgrdind
     * @return NSPL
     */
    public function setOsgrdind(?float $osgrdind): NSPL
    {
        $this->osgrdind = $osgrdind;

        return $this;
    }

    /**
     * @param float|null $osnrth1m
     * @return NSPL
     */
    public function setOsnrth1m(?float $osnrth1m): NSPL
    {
        $this->osnrth1m = $osnrth1m;

        return $this;
    }

    /**
     * @param float|null $oseast1m
     * @return NSPL
     */
    public function setOseast1m(?float $oseast1m): NSPL
    {
        $this->oseast1m = $oseast1m;

        return $this;
    }

    /**
     * @param bool|null $usertype
     * @return NSPL
     */
    public function setUsertype(?bool $usertype): NSPL
    {
        $this->usertype = $usertype;

        return $this;
    }

    /**
     * @param null|string $doterm
     * @return NSPL
     */
    public function setDoterm(?string $doterm): NSPL
    {
        $this->doterm = $doterm;

        return $this;
    }

    /**
     * @param null|string $dointr
     * @return NSPL
     */
    public function setDointr(?string $dointr): NSPL
    {
        $this->dointr = $dointr;

        return $this;
    }

    /**
     * @param null|string $pcds
     * @return NSPL
     */
    public function setPcds(?string $pcds): NSPL
    {
        $this->pcds = $pcds;

        return $this;
    }

    /**
     * @param null|string $pcd2
     * @return NSPL
     */
    public function setPcd2(?string $pcd2): NSPL
    {
        $this->pcd2 = $pcd2;

        return $this;
    }

    // Constructor

    /**
     * @param string $pcd |null
     *
     * @return NSPL
     */
    public function setPcd(?string $pcd): NSPL
    {
        $this->pcd = $pcd;

        return $this;
    }

    // Core functionality

    /**
     * Save to the database
     */
    public function save()
    {
        DB::table('postcode_nspls')->insert(
            [
                'pcd' => $this->getPcd(),
                'pcd2' => $this->getPcd2(),
                'pcds' => $this->getPcds(),
                'dointr' => $this->getDointr(),
                'doterm' => $this->getDoterm(),
                'usertype' => $this->getUsertype(),
                'oseast1m' => $this->getOseast1m(),
                'osnrth1m' => $this->getOsnrth1m(),
                'osgrdind' => $this->getOsgrdind(),
                'oa11' => $this->getOal1(),
                'cty' => $this->getCty(),
                'ced' => $this->getCed(),
                'laua' => $this->getLaua(),
                'ward' => $this->getWard(),
                'hlthau' => $this->getHlthau(),
                'nhser' => $this->getNhser(),
                'ctry' => $this->getCtry(),
                'rgn' => $this->getRgn(),
                'pcon' => $this->getPcon(),
                'eer' => $this->getEer(),
                'teclec' => $this->getTeclec(),
                'ttwa' => $this->getTtwa(),
                'pct' => $this->getPct(),
                'nuts' => $this->getNuts(),
                'park' => $this->getPark(),
                'lsoa11' => $this->getLsoa11(),
                'msoa11' => $this->getMsoa11(),
                'wz11' => $this->getWz11(),
                'ccg' => $this->getCcg(),
                'bua11' => $this->getBua11(),
                'buasd11' => $this->getBuasd11(),
                'ru11ind' => $this->getRu11ind(),
                'oac11' => $this->getOac11(),
                'lat' => $this->getLat(),
                'long' => $this->getLong(),
                'lep1' => $this->getLep1(),
                'lep2' => $this->getLep2(),
                'pfa' => $this->getPfa(),
                'imd' => $this->getImd(),
                'calncv' => $this->getCalncv(),
                'stp' => $this->getStp()
            ]
        );
    }
}