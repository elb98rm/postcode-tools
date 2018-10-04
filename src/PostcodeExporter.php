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
    public function exportPostcodesToCsv(array $postcodes, ?string $output_url = null, bool $full_loads = false): bool
    {
        $return = false;
        $array = [];

        foreach ($postcodes as $postcode) {
            $array[$postcode->getPcd()] = [
                'pcd' => $postcode->getPcd(),
                'pcd2' => $postcode->getPcd2(),
                'pcds' => $postcode->getPcds(),
                'dointr' => $postcode->getDointr(),
                'doterm' => $postcode->getDoterm(),
                'usertype' => $postcode->getUsertype(),
                'oseast1m' => $postcode->getOseast1m(),
                'osnrth1m' => $postcode->getOsnrth1m(),
                'osgrdind' => $postcode->getOsgrdind(),
                'oa11' => $postcode->getOal1(),
                'cty' => $postcode->getCty(),
                'ced' => $postcode->getCed(),
                'laua' => $postcode->getLaua(),
                'ward' => $postcode->getWard(),
                'hlthau' => $postcode->getHlthau(),
                'nhser' => $postcode->getNhser(),
                'ctry' => $postcode->getCtry(),
                'rgn' => $postcode->getRgn(),
                'pcon' => $postcode->getPcon(),
                'eer' => $postcode->getEer(),
                'teclec' => $postcode->getTeclec(),
                'ttwa' => $postcode->getTtwa(),
                'pct' => $postcode->getPct(),
                'nuts' => $postcode->getNuts(),
                'park' => $postcode->getPark(),
                'lsoa11' => $postcode->getLsoa11(),
                'msoa11' => $postcode->getMsoa11(),
                'wz11' => $postcode->getWz11(),
                'ccg' => $postcode->getCcg(),
                'bua11' => $postcode->getBua11(),
                'buasd11' => $postcode->getBuasd11(),
                'ru11ind' => $postcode->getRu11ind(),
                'oac11' => $postcode->getOac11(),
                'lat' => $postcode->getLat(),
                'long' => $postcode->getLong(),
                'lep1' => $postcode->getLep1(),
                'lep2' => $postcode->getLep2(),
                'pfa' => $postcode->getPfa(),
                'imd' => $postcode->getImd(),
                'calncv' => $postcode->getCalncv(),
                'stp' => $postcode->getStp()
            ];

            if ($full_loads) {
                $array[$postcode->getPcd()]['usertype_verbose'] = $postcode->getUsertypeVerbose();
                $array[$postcode->getPcd()]['osgrdind_verbose'] = $postcode->getOsgrdindVerbose();
                $array[$postcode->getPcd()]['ced17nm'] = $postcode->getCed17nm();
                $array[$postcode->getPcd()]['lad16nm'] = $postcode->getLad17nm();
                $array[$postcode->getPcd()]['wd17nm'] = $postcode->getWd17nm();
                $array[$postcode->getPcd()]['nhser17nm'] = $postcode->getNhser17nm();
                $array[$postcode->getPcd()]['ctry12nm'] = $postcode->getCtry12nm();
                $array[$postcode->getPcd()]['gor10nm'] = $postcode->getGor10nm();
                $array[$postcode->getPcd()]['pcon14nm'] = $postcode->getPcon14nm();
                $array[$postcode->getPcd()]['eer10nm'] = $postcode->getEer10nm();
                $array[$postcode->getPcd()]['teclecnm'] = $postcode->getTeclecnm();
                $array[$postcode->getPcd()]['ttwa11nm'] = $postcode->getTtwa11nm();
                $array[$postcode->getPcd()]['lau216nm'] = $postcode->getLau216nm();
                $array[$postcode->getPcd()]['npark16nm'] = $postcode->getNpark16nm();
                $array[$postcode->getPcd()]['ccg18nm'] = $postcode->getCcg18nm();
                $array[$postcode->getPcd()]['bua13nm'] = $postcode->getBua13nm();
                $array[$postcode->getPcd()]['buasd13nm'] = $postcode->getBuasd13nm();
                $array[$postcode->getPcd()]['ru11nm'] = $postcode->getRu11nm();
                $array[$postcode->getPcd()]['oac11_supergroup'] = $postcode->getOac11Supergroup();
                $array[$postcode->getPcd()]['oac11_group'] = $postcode->getOac11Group();
                $array[$postcode->getPcd()]['oac11_subgroup'] = $postcode->getOac11Subgroup();
                $array[$postcode->getPcd()]['lep1_lep17nm'] = $postcode->getLep1Lep17nm();
                $array[$postcode->getPcd()]['lep2_lep17nm'] = $postcode->getLep2Lep17nm();
                $array[$postcode->getPcd()]['pfa15nm'] = $postcode->getPfa15nm();
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