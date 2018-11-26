<?php
/**
 * NSPLFileNameTransformer.php
 *
 * NSPLFileNameTransformer class
 *
 * php 7.2+
 *
 * @category  None
 * @package   Floor9design\DatabaseTools
 * @author    Will Otterburn <will.otterburn@agepartnership.com>
 * @copyright Floor9design Ltd (floor9design.com)
 * @license   MIT
 * @version   1.0
 * @link      http://floor9design.com
 * @see       ../docs/main/objects.md#DevelopmentConnection
 * @since     File available since Release 1.0
 *
 */

namespace Floor9design\PostcodeTools;

class NSPLFileNameTransformer
{
    private $map = [
        'NSPL_' => 'nspls',
        'County names and codes UK as at' => 'counties',
        'County Electoral Division names and codes EN as at' => 'ceds',
        'LA_UA names and codes UK as at' => 'lauas',
        'Ward names and codes UK as at' => 'wards',
        'HLTHAU names and codes UK as at' => 'hlthaus',
        'NHSER names and codes EN as at' => 'nhsers',
        'Country names and codes UK as at' => 'countries',
        'Region names and codes EN as at' => 'rgns',
        'Westminster Parliamentary Constituency names and codes UK as at' => 'pcons',
        'EER names and codes UK as at' => 'eers',
        'TECLEC names and codes UK as at' => 'teclecs',
        'TTWA names and codes UK as at' => 'ttwas',
        'PCT names and codes UK as at' => 'pcts',
        'LAU2 names and codes UK as at' => 'nutss',
        'National Park names and codes GB as at' => 'parks',
        'LSOA (2011) names and codes UK as at' => 'lsoa11s',
        'MSOA (2011) names and codes UK as at' => 'msoa11s',
        'CCG names and codes UK as at' => 'ccgs',
        'BUA_names and codes UK as at' => 'bua11s',
        'BUASD_names and codes UK as at' => 'buasd11s',
        'Rural Urban (2011) Indicator names and codes GB as at' => 'ru11inds',
        '2011 Census Output Area Classification Names and Codes UK' => 'oac11s',
        'LEP names and codes EN as at' => 'leps',
        'PFA names and codes GB as at' => 'pfas',
        'IMD lookup EN as at' => 'imd_ens',
        'IMD lookup SC as at' => 'imd_scs',
        'IMD lookup WA as at' => 'imd_was'
    ];

    private function startsWith($haystack, $needle) : bool
    {
        return strpos($haystack, $needle) === 0;
    }

    private function mapName($name) : string
    {
        foreach ($this->map as $orig => $dest) {
            if ($this->startsWith($name, $orig)) {
                return $dest;
            }
        }
        return $name;
    }

    public function transform($name) : string {
        
        return $this->mapName($name);
    }
}