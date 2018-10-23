<?php
/**
 * PostcodeExporter.php
 *
 * PostcodeExporter class
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
 * @see       ../docs/main/objects.md#PostcodeExporter
 * @since     File available since Release 1.0
 *
 */

namespace Floor9design\PostcodeTools;

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class PostcodeExporter
 *
 * Provides tools for batch processing postcodes
 *
 * @category  None
 * @package   Floor9design\PostcodeTools
 * @author    Rick Morice <rick@floor9design.com>
 * @copyright Floor9design Ltd (floor9design.com)
 * @license   MIT
 * @version   1.0
 * @link      http://floor9design.com
 * @see       ../docs/main/objects.md#PostcodeExporter
 * @since     File available since Release 1.0
 */
class PostcodeExporter
{
    /**
     * An array of Postcode objects
     *
     * @var null|array $postcodes
     */
    var $postcodes;

    /**
     * An array to manually specify the main postcode data from the postcode
     *
     * @var array $core_data
     */
    var $core_data = [
        'postcode',
        'area',
        'district',
        'outward_code',
        'sector',
        'unit',
        'inward_code'
    ];

    /**
     * An array to manually specify export fields to output
     *
     * @var array $export_fields
     */
    var $export_fields = [
        'pcd',
        'pcd2',
        'pcds',
        'dointr',
        'doterm',
        'usertype',
        'oseast1m',
        'osnrth1m',
        'osgrdind',
        'oa11',
        'cty',
        'ced',
        'laua',
        'ward',
        'hlthau',
        'nhser',
        'ctry',
        'rgn',
        'pcon',
        'eer',
        'teclec',
        'ttwa',
        'pct',
        'nuts',
        'park',
        'lsoa11',
        'msoa11',
        'wz11',
        'ccg',
        'bua11',
        'buasd11',
        'ru11ind',
        'oac11',
        'lat',
        'long',
        'lep1',
        'lep2',
        'pfa',
        'imd',
        'calncv',
        'stp'
    ];

    /**
     * An array to manually specify extended export fields to output
     *
     * @var array $export_fields
     */
    var $extended_export_fields = [
        'usertype_verbose',
        'osgrdind_verbose',
        'ced17nm',
        'lad16nm',
        'wd17nm',
        'nhser17nm',
        'ctry12nm',
        'gor10nm',
        'pcon14nm',
        'eer10nm',
        'teclecnm',
        'ttwa11nm',
        'lau216nm',
        'npark16nm',
        'ccg18nm',
        'bua13nm',
        'buasd13nm',
        'ru11nm',
        'oac11_supergroup',
        'oac11_group',
        'oac11_subgroup',
        'lep1_lep17nm',
        'lep2_lep17nm',
        'pfa15nm',
    ];

    /**
     * An array to manually specify further relation export fields to output
     *
     * @var array
     */
    var $further_relations_fields = [
        'tv_region',
        'nationwide_hpi_authority_code',
        'nationwide_local_authority'
    ];

    // accessors

    /**
     * @see $postcodes
     *
     * @return array|null
     */
    public function getPostcodes(): ?array
    {
        return $this->postcodes;
    }

    /**
     * @see $postcodes
     *
     * @param array|null $postcodes
     * @return PostcodeExporter
     */
    public function setPostcodes(?array $postcodes): PostcodeExporter
    {
        $this->postcodes = $postcodes;

        return $this;
    }

    /**
     * @see $core_data
     *
     * @return array
     */
    public function getCoreData(): array
    {
        return $this->core_data;
    }

    /**
     * @see $core_data
     *
     * @param array $core_data
     * @return PostcodeExporter
     */
    public function setCoreData(array $core_data): PostcodeExporter
    {
        $this->core_data = $core_data;

        return $this;
    }

    /**
     * @see $export_fields
     *
     * @return array
     */
    public function getExportFields(): array
    {
        return $this->export_fields;
    }

    /**
     * @see $export_fields
     *
     * @param array $export_fields
     * @return PostcodeExporter
     */
    public function setExportFields(array $export_fields): PostcodeExporter
    {
        $this->export_fields = $export_fields;

        return $this;
    }

    /**
     * @see $extended_export_fields
     *
     * @return array
     */
    public function getExtendedExportFields(): array
    {
        return $this->extended_export_fields;
    }

    /**
     * @see $extended_export_fields
     *
     * @param array $extended_export_fields
     * @return PostcodeExporter
     */
    public function setExtendedExportFields(array $extended_export_fields): PostcodeExporter
    {
        $this->extended_export_fields = $extended_export_fields;

        return $this;
    }

    /**
     * @see $further_relations_fields
     *
     * @return array
     */
    public function getFurtherFields(): array
    {
        return $this->further_relations_fields;
    }

    /**
     * @see $further_relations_fields
     *
     * @param array $further_relations_fields
     * @return PostcodeExporter
     */
    public function setFurtherFields(array $further_relations_fields): PostcodeExporter
    {
        $this->further_relations_fields = $further_relations_fields;

        return $this;
    }

    // general functions

    /**
     * Takes a basic array of postcodes and processed them into an array of Postcode objects with optional full loads
     *
     * @param array $postcodes
     * @param bool $full_loads
     * @return array
     */
    public function validateMultiplePostcodes(array $postcodes, Capsule $capsule, bool $full_loads = false): array
    {
        $processed_postcodes = [];

        foreach ($postcodes as $postcode) {

            $new_postcode = new Postcode($postcode, $capsule, $full_loads);

            $processed_postcodes[$postcode] = $new_postcode;
        }

        $this->setPostcodes($processed_postcodes);

        return $processed_postcodes;
    }

    /**
     * Processes an array of Postcode objects into a CSV output, responding with a bool to indicate progress.
     *
     * @param array $postcodes
     * @param null|string $output_url
     * @param bool $full_loads
     * @return bool
     */
    public function exportPostcodesToCsv(?string $output_url = null, bool $full_loads = false): bool
    {
        $return = false;
        $array = [];

        foreach ($this->postcodes as $postcode) {

            // core_data
            if(in_array('postcode', $this->getCoreData())){
                $array[$postcode->getPcd()]['postcode'] = $postcode->getPcd();
            }
            if(in_array('area', $this->getCoreData())){
                $array[$postcode->getPcd()]['area'] = $postcode->getArea();
            }
            if(in_array('area', $this->getCoreData())){
                $array[$postcode->getPcd()]['area'] = $postcode->getDistrict();
            }
            if(in_array('outward_code', $this->getCoreData())){
                $array[$postcode->getPcd()]['outward_code'] = $postcode->getOutwardCode();
            }
            if(in_array('sector', $this->getCoreData())){
                $array[$postcode->getPcd()]['sector'] = $postcode->getSector();
            }
            if(in_array('unit', $this->getCoreData())){
                $array[$postcode->getPcd()]['unit'] = $postcode->getSector();
            }
            if(in_array('inward_code', $this->getCoreData())){
                $array[$postcode->getPcd()]['inward_code'] = $postcode->getInwardCode();
            }

            // export_fields

            if(in_array('pcd', $this->getExportFields())){
                $array[$postcode->getPcd()]['pcd'] = $postcode->getPcd();
            }
            if(in_array('pcd2', $this->getExportFields())){
                $array[$postcode->getPcd()]['pcd2'] = $postcode->getPcd2();
            }
            if(in_array('pcds', $this->getExportFields())){
                $array[$postcode->getPcd()]['pcds'] = $postcode->getPcds();
            }
            if(in_array('dointr', $this->getExportFields())){
                $array[$postcode->getPcd()]['dointr'] = $postcode->getDointr();
            }
            if(in_array('doterm', $this->getExportFields())){
                $array[$postcode->getPcd()]['doterm'] = $postcode->getDointr();
            }
            if(in_array('usertype', $this->getExportFields())){
                $array[$postcode->getPcd()]['usertype'] = $postcode->getUsertype();
            }
            if(in_array('oseast1m', $this->getExportFields())){
                $array[$postcode->getPcd()]['oseast1m'] = $postcode->getOseast1m();
            }
            if(in_array('osnrth1m', $this->getExportFields())){
                $array[$postcode->getPcd()]['osnrth1m'] = $postcode->getOsnrth1m();
            }
            if(in_array('osgrdind', $this->getExportFields())){
                $array[$postcode->getPcd()]['osgrdind'] = $postcode->getOsgrdind();
            }
            if(in_array('oa11', $this->getExportFields())){
                $array[$postcode->getPcd()]['oa11'] = $postcode->getOal1();
            }
            if(in_array('cty', $this->getExportFields())){
                $array[$postcode->getPcd()]['cty'] = $postcode->getCty();
            }
            if(in_array('ced', $this->getExportFields())){
                $array[$postcode->getPcd()]['ced'] = $postcode->getCed();
            }
            if(in_array('laua', $this->getExportFields())){
                $array[$postcode->getPcd()]['laua'] = $postcode->getLaua();
            }
            if(in_array('ward', $this->getExportFields())){
                $array[$postcode->getPcd()]['laua'] = $postcode->getWard();
            }
            if(in_array('hlthau', $this->getExportFields())){
                $array[$postcode->getPcd()]['hlthau'] = $postcode->getHlthau();
            }
            if(in_array('nhser', $this->getExportFields())){
                $array[$postcode->getPcd()]['nhser'] = $postcode->getNhser();
            }
            if(in_array('ctry', $this->getExportFields())){
                $array[$postcode->getPcd()]['ctry'] = $postcode->getCtry();
            }
            if(in_array('rgn', $this->getExportFields())){
                $array[$postcode->getPcd()]['rgn'] = $postcode->getRgn();
            }
            if(in_array('pcon', $this->getExportFields())){
                $array[$postcode->getPcd()]['pcon'] = $postcode->getPcon();
            }
            if(in_array('eer', $this->getExportFields())){
                $array[$postcode->getPcd()]['eer'] = $postcode->getEer();
            }
            if(in_array('teclec', $this->getExportFields())){
                $array[$postcode->getPcd()]['teclec'] = $postcode->getTeclec();
            }
            if(in_array('ttwa', $this->getExportFields())){
                $array[$postcode->getPcd()]['ttwa'] = $postcode->getTtwa();
            }
            if(in_array('pct', $this->getExportFields())){
                $array[$postcode->getPcd()]['pct'] = $postcode->getPct();
            }
            if(in_array('nuts', $this->getExportFields())){
                $array[$postcode->getPcd()]['nuts'] = $postcode->getNuts();
            }
            if(in_array('park', $this->getExportFields())){
                $array[$postcode->getPcd()]['park'] = $postcode->getPark();
            }
            if(in_array('lsoa11', $this->getExportFields())){
                $array[$postcode->getPcd()]['lsoa11'] = $postcode->getLsoa11();
            }
            if(in_array('msoa11', $this->getExportFields())){
                $array[$postcode->getPcd()]['msoa11'] = $postcode->getMsoa11();
            }
            if(in_array('wz11', $this->getExportFields())){
                $array[$postcode->getPcd()]['wz11'] = $postcode->getWz11();
            }
            if(in_array('ccg', $this->getExportFields())){
                $array[$postcode->getPcd()]['ccg'] = $postcode->getCcg();
            }
            if(in_array('bua11', $this->getExportFields())){
                $array[$postcode->getPcd()]['bua11'] = $postcode->getBua11();
            }
            if(in_array('buasd11', $this->getExportFields())){
                $array[$postcode->getPcd()]['buasd11'] = $postcode->getBuasd11();
            }
            if(in_array('ru11ind', $this->getExportFields())){
                $array[$postcode->getPcd()]['ru11ind'] = $postcode->getRu11ind();
            }
            if(in_array('oac11', $this->getExportFields())){
                $array[$postcode->getPcd()]['oac11'] = $postcode->getOac11();
            }
            if(in_array('lat', $this->getExportFields())){
                $array[$postcode->getPcd()]['lat'] = $postcode->getLat();
            }
            if(in_array('long', $this->getExportFields())){
                $array[$postcode->getPcd()]['long'] = $postcode->getLong();
            }
            if(in_array('lep1', $this->getExportFields())){
                $array[$postcode->getPcd()]['lep1'] = $postcode->getLep1();
            }
            if(in_array('lep2', $this->getExportFields())){
                $array[$postcode->getPcd()]['lep2'] = $postcode->getLep2();
            }
            if(in_array('pfa', $this->getExportFields())){
                $array[$postcode->getPcd()]['pfa'] = $postcode->getPfa();
            }
            if(in_array('imd', $this->getExportFields())){
                $array[$postcode->getPcd()]['imd'] = $postcode->getImd();
            }
            if(in_array('calncv', $this->getExportFields())){
                $array[$postcode->getPcd()]['calncv'] = $postcode->getCalncv();
            }
            if(in_array('stp', $this->getExportFields())){
                $array[$postcode->getPcd()]['stp'] = $postcode->getStp();
            }

            if ($full_loads) {

                // extended_export_fields

                if(in_array('usertype_verbose', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['usertype_verbose'] = $postcode->getUsertypeVerbose();
                }
                if(in_array('osgrdind_verbose', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['osgrdind_verbose'] = $postcode->getOsgrdindVerbose();
                }
                if(in_array('ced17nm', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['ced17nm'] = $postcode->getCed17nm();
                }
                if(in_array('lad16nm', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['lad16nm'] = $postcode->getLad16nm();
                }
                if(in_array('wd17nm', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['wd17nm'] = $postcode->getWd17nm();
                }
                if(in_array('nhser17nm', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['nhser17nm'] = $postcode->getNhser17nm();
                }
                if(in_array('ctry12nm', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['ctry12nm'] = $postcode->getCtry12nm();
                }
                if(in_array('gor10nm', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['gor10nm'] = $postcode->getGor10nm();
                }
                if(in_array('pcon14nm', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()][] = $postcode->getPcon14nm();
                }
                if(in_array('eer10nm', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['eer10nm'] = $postcode->getEer10nm();
                }
                if(in_array('teclecnm', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['teclecnm'] = $postcode->getTeclecnm();
                }
                if(in_array('ttwa11nm', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['ttwa11nm'] = $postcode->getTtwa11nm();
                }
                if(in_array('ttwa11nm', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['ttwa11nm'] = $postcode->getTtwa11nm();
                }
                if(in_array('lau216nm', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['lau216nm'] = $postcode->getLau216nm();
                }
                if(in_array('npark16nm', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['npark16nm'] = $postcode->getNpark16nm();
                }
                if(in_array('ccg18nm', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['ccg18nm'] = $postcode->getCcg18nm();
                }
                if(in_array('bua13nm', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['bua13nm'] = $postcode->getBua13nm();
                }
                if(in_array('buasd13nm', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['buasd13nm'] = $postcode->getBuasd13nm();
                }
                if(in_array('ru11nm', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['ru11nm'] = $postcode->getRu11nm();
                }
                if(in_array('oac11_supergroup', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['oac11_supergroup'] = $postcode->getOac11Supergroup();
                }
                if(in_array('oac11_group', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['oac11_group'] = $postcode->getOac11Group();
                }
                if(in_array('oac11_subgroup', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['oac11_subgroup'] = $postcode->getOac11Subgroup();
                }
                if(in_array('lep1_lep17nm', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['lep1_lep17nm'] = $postcode->getLep1Lep17nm();
                }
                if(in_array('lep2_lep17nm', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['lep2_lep17nm'] = $postcode->getLep2Lep17nm();
                }
                if(in_array('pfa15nm', $this->getExtendedExportFields())){
                    $array[$postcode->getPcd()]['pfa15nm'] = $postcode->getPfa15nm();
                }

                // further_relations_fields
                if(in_array('tv_region', $this->getFurtherFields())){
                    $array[$postcode->getPcd()]['tv_region'] = $postcode->getTvRegion();
                }

                if(in_array('nationwide_hpi_authority_code', $this->getFurtherFields())){
                    $array[$postcode->getPcd()]['nationwide_hpi_authority_code'] = $postcode->getNationwideHpiAuthorityCode();
                }

                if(in_array('nationwide_local_authority', $this->getFurtherFields())){
                    $array[$postcode->getPcd()]['nationwide_local_authority'] = $postcode->getNationwideHpiAuthorityCode();
                }

            }

        }

        ob_start();
        $df = fopen($output_url, 'w');
        fputcsv($df, array_keys(reset($array)));
        foreach ($array as $row) {
            fputcsv($df, $row);
        }
        fclose($df);
        ob_get_clean();

        if (file_exists($output_url)) {
            $return = true;
        }

        return $return;
    }

}