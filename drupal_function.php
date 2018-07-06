<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Add custom URLs to XML Sitemap
 *
 * This is a companion for the XML Sitemap module.
 * It makes it easier to add multiple URLs to the sitemap easily.
 *
 * PHP version 7
 *
 * @category   Search
 * @package    DaVinci
 * @author     Original Author <author@example.com>
 * @author     Another Author <another@example.com>
 * @copyright  2018 Queens Library
 * @license    http://www.queenslibrary.org
 * @version    GIT: $Id$
 * @link       https://www.drupal.org/project/xmlsitemap
 * @see        XMLSitemap
 * @since      File available since May 2018
 * @deprecated Not deprecated
 */

/**
 * This module will add/replace custom sitemaps in the xmlsitemap table
 *
 * @category   Search
 * @package    DaVinci
 * @author     Original Author <author@example.com>
 * @author     Another Author <another@example.com>
 * @copyright  2018 Queens Library
 * @license    http://www.queenslibrary.org
 * @version    Release: @0.0.0@
 * @link       https://www.drupal.org/project/xmlsitemap
 * @see        DaVinci, Net_Sample::Net_Sample()
 * @since      File available since May 2018
 * @deprecated Not deprecated
 */
class MyCSV
{
    /**
     * @param $locations    array This is the location array, I expect strings
     * @param $dates        array This is the dates array, I expect UNIX timestamps
     */
    static function writeXMLSitemap($locations, $dates)
    {
        $baseUrl = "https://dev.qbpl.org";
        $extension = "/bib/";
        $priority = "0.5";
        $size = 50000;
        for ($counter = 0; $counter < ceil(count($locations) / $size); $counter++) {
            $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');
            for ($i = 0; $i < $size; $i++) {
                if ($i + $counter * $size > count($locations) - 1) {
                    break;
                }
                $url = $xml->addChild('url');
                $url->addChild('loc', $baseUrl . $extension . (string)$locations[$i + $counter * $size]);
                $url->addChild('lastmod', date('Y-m-dTh:m', $dates[$i + $counter * $size]));
                $url->addChild('changefreq', "weekly");
                $url->addChild('priority', $priority);
            }
            //Format XML to save indented tree rather than one line
            $dom = new DOMDocument($priority);
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->loadXML($xml->asXML());
            //Save XML to file - remove this and following line if save not desired
            $dom->save('bibliographysitemap' . $counter . '.xml');
        }
        self::writeXMLSitemapIndex($baseUrl, $counter);
    }

    /**
     * Write the CSV
     *
     * @param array $locations array of locations as integers
     * @param array $languages array of languages as integers
     * @param array $dates array of dates as integers (UNIX timestamps)
     *
     * @return void return nothing
     */
    static function writeCSV($locations, $languages, $dates)
    {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="sitemap.csv"');
        foreach ($locations as &$location) {
            $location = "/bib/" . $location;
        }
        $type = "custom";
        $subtype = "";

        $access = 1;
        $status = 1;
        $status_override = 0;

        $priority = "0.5";
        $priority_override = 0;
        $changefreq = "86400";
        $changecount = 0;
        $sravan = array();
        foreach ($locations as $key => $location) {
            $language = MyCSV::getIso6391from6392($languages[$key]);
            $lastmod = $dates[$key];
            $randomID = MyCSV::getRandomID();
            $sravan[] = $randomID . "," . $type . "," . $subtype . "," . $location
                . "," . $language . "," . $access . "," . $status
                . "," . $status_override . "," . $lastmod . "," . $priority
                . "," . $priority_override . "," . $changefreq . "," . $changecount;
        }

        $fp = fopen('php://output', 'w');
        $columns = "id,type,subtype,location,language,access,status,status_override,"
            . "lastmod,priority,priority_override,changefreq,changecount";
        fputcsv(
            $fp,
            explode(
                ",",
                $columns
            )
        );
        foreach ($sravan as $line) {
            $val = explode(",", $line);
            fputcsv($fp, $val);
        }
        fclose($fp);
    }

// function updateCSV($pdo, $uploadfile)
// {
//     echo "Hello, world!";
//     $delete_statement = "delete from xmlsitemap where type = 'custom'";
//     $pdo->exec($delete_statement);
//     // LOAD DATA LOCAL INFILE '/home/kus/src/php/csv/sitemap.csv' INTO TABLE studentdb.xmlsitemap FIELDS TERMINATED BY ',' ignore 1 lines;
//     $statement = "LOAD DATA LOCAL INFILE '" . $uploadfile . "' INTO TABLE `xmlsitemap` FIELDS TERMINATED BY ',' ignore 1 lines";
//     $statement = $pdo->exec($statement);
//     echo "query done";
// }

    /**
     * Get UNIX timestamp from input time
     *
     * @param string $stringDate input string e.g. "08/28/2014"
     *
     * @return int returns UNIX time stamp
     */
    static function getUnixTimestamp($stringDate)
    {
        return strtotime($stringDate);
    }

    /**
     * Parse input csv file and return three arrays for further processing
     *
     * @param string $inputFileName input file (CSV)
     *
     * @return array returns 'csvform'
     */
    static function readInputFile($inputFileName)
    {
        $row = 1;
        $locations = array();
        $languages = array();
        $dates = array();
        if (($handle = fopen($inputFileName, "r")) !== false) {
            file($inputFileName, FILE_SKIP_EMPTY_LINES);
            // if (count($fp) > $maxCSV) {
            //     echo "This load of {count($fp)} is too big for me";
            //     die();
            // }
            // ignore the first line
            fgetcsv($handle, 0, ",");
            while (($data = fgetcsv($handle, 0, ",")) !== false) {
                $num = count($data);
                // echo "<p> $num fields in line $row: <br /></p>\n";
                for ($c = 0; $c < $num; $c++) {
                    // echo $data[$c] . "<br />\n";
                    if ($c == 0) {
                        array_push($locations, $data[$c]);
                    }
                    if ($c == 1) {
                        array_push($languages, $data[$c]);
                    }
                    if ($c == 2) {
                        array_push($dates, MyCSV::getUnixTimestamp($data[$c]));
                    }
                }
                $row++;
            }
            fclose($handle);
        }
        return array($locations, $languages, $dates);
    }

    /**
     * Returns a GUIDv4 string
     *
     * Uses the best cryptographically secure method
     * for all supported pltforms with fallback to an older,
     * less secure version.
     *
     * @param bool $trim to trim or not to trim
     *
     * @return string
     */
    static function getRandomID($trim = true)
    {
        // Windows
        if (function_exists('com_create_guid') === true) {
            if ($trim === true) {
                return trim(com_create_guid(), '{}');
            } else {
                return com_create_guid();
            }
        }

        // OSX/Linux
        if (function_exists('openssl_random_pseudo_bytes') === true) {
            $data = openssl_random_pseudo_bytes(16);
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
            return vsprintf('%s%s%s%s%s%s%s%s', str_split(bin2hex($data), 4));
        }

        // Fallback (PHP 4.2+)
        mt_srand((double)microtime() * 10000);
        $charid = strtolower(md5(uniqid(rand(), true)));
        $hyphen = chr(45);                  // "-"
        $lbrace = $trim ? "" : chr(123);    // "{"
        $rbrace = $trim ? "" : chr(125);    // "}"
        $guidv4 = $lbrace .
            substr($charid, 0, 8) . $hyphen .
            substr($charid, 8, 4) . $hyphen .
            substr($charid, 12, 4) . $hyphen .
            substr($charid, 16, 4) . $hyphen .
            substr($charid, 20, 12) .
            $rbrace;
        return $guidv4;
    }

    /**
     * Returns an ISO 639-1 language code given an ISO 639-2 language code
     *
     * This list is incomplete.
     * You can help by expanding it.
     * Most of the items in the list are commented out.
     * You should only uncomment those that you have in your Drupal installation
     *
     * @param string $key the key is a string like "en"
     *
     * @return string
     */
    static function getIso6391from6392($key)
    {
        $languageCodes = [
            //     "aar" => "aa",
            //     "abk" => "ab",
            //     "afr" => "af",
            //     "aka" => "ak",
            //     "alb" => "sq",
            //     "amh" => "am",
            //     "ara" => "ar",
            //     "arg" => "an",
            //     "arm" => "hy",
            //     "asm" => "as",
            //     "ava" => "av",
            //     "ave" => "ae",
            //     "aym" => "ay",
            //     "aze" => "az",
            //     "bak" => "ba",
            //     "bam" => "bm",
            //     "baq" => "eu",
            //     "bel" => "be",
            //     "ben" => "bn",
            //     "bih" => "bh",
            //     "bis" => "bi",
            //     "tib" => "bo",
            //     "bos" => "bs",
            //     "bre" => "br",
            //     "bul" => "bg",
            //     "bur" => "my",
            //     "cat" => "ca",
            //     "cze" => "cs",
            //     "cha" => "ch",
            //     "che" => "ce",
            //     "chi" => "zh",
            //     "chu" => "cu",
            //     "chv" => "cv",
            //     "cor" => "kw",
            //     "cos" => "co",
            //     "cre" => "cr",
            //     "wel" => "cy",
            //     "cze" => "cs",
            //     "dan" => "da",
            //     "ger" => "de",
            //     "div" => "dv",
            //     "dut" => "nl",
            //     "dzo" => "dz",
            //     "gre" => "el",
            "eng" => "en",
            //     "epo" => "eo",
            //     "est" => "et",
            //     "baq" => "eu",
            //     "ewe" => "ee",
            //     "fao" => "fo",
            //     "per" => "fa",
            //     "fij" => "fj",
            //     "fin" => "fi",
            //     "fre" => "fr",
            //     "fre" => "fr",
            //     "fry" => "fy",
            //     "ful" => "ff",
            //     "geo" => "ka",
            //     "ger" => "de",
            //     "gla" => "gd",
            //     "gle" => "ga",
            //     "glg" => "gl",
            //     "glv" => "gv",
            //     "gre" => "el",
            //     "grn" => "gn",
            //     "guj" => "gu",
            //     "hat" => "ht",
            //     "hau" => "ha",
            //     "heb" => "he",
            //     "her" => "hz",
            //     "hin" => "hi",
            //     "hmo" => "ho",
            //     "hrv" => "hr",
            //     "hun" => "hu",
            //     "arm" => "hy",
            //     "ibo" => "ig",
            //     "ice" => "is",
            //     "ido" => "io",
            //     "iii" => "ii",
            //     "iku" => "iu",
            //     "ile" => "ie",
            //     "ina" => "ia",
            //     "ind" => "id",
            //     "ipk" => "ik",
            //     "ice" => "is",
            //     "ita" => "it",
            //     "jav" => "jv",
            //     "jpn" => "ja",
            //     "kal" => "kl",
            //     "kan" => "kn",
            //     "kas" => "ks",
            //     "geo" => "ka",
            //     "kau" => "kr",
            //     "kaz" => "kk",
            //     "khm" => "km",
            //     "kik" => "ki",
            //     "kin" => "rw",
            //     "kir" => "ky",
            //     "kom" => "kv",
            //     "kon" => "kg",
            //     "kor" => "ko",
            //     "kua" => "kj",
            //     "kur" => "ku",
            //     "lao" => "lo",
            //     "lat" => "la",
            //     "lav" => "lv",
            //     "lim" => "li",
            //     "lin" => "ln",
            //     "lit" => "lt",
            //     "ltz" => "lb",
            //     "lub" => "lu",
            //     "lug" => "lg",
            //     "mac" => "mk",
            //     "mah" => "mh",
            //     "mal" => "ml",
            //     "mao" => "mi",
            //     "mar" => "mr",
            //     "may" => "ms",
            //     "mac" => "mk",
            //     "mlg" => "mg",
            //     "mlt" => "mt",
            //     "mon" => "mn",
            //     "mao" => "mi",
            //     "may" => "ms",
            //     "bur" => "my",
            //     "nau" => "na",
            //     "nav" => "nv",
            //     "nbl" => "nr",
            //     "nde" => "nd",
            //     "ndo" => "ng",
            //     "nep" => "ne",
            //     "dut" => "nl",
            //     "nno" => "nn",
            //     "nob" => "nb",
            //     "nor" => "no",
            //     "nya" => "ny",
            //     "oci" => "oc",
            //     "oji" => "oj",
            //     "ori" => "or",
            //     "orm" => "om",
            //     "oss" => "os",
            //     "pan" => "pa",
            //     "per" => "fa",
            //     "pli" => "pi",
            //     "pol" => "pl",
            //     "por" => "pt",
            //     "pus" => "ps",
            //     "que" => "qu",
            //     "roh" => "rm",
            //     "rum" => "ro",
            //     "rum" => "ro",
            //     "run" => "rn",
            //     "rus" => "ru",
            //     "sag" => "sg",
            //     "san" => "sa",
            //     "sin" => "si",
            //     "slo" => "sk",
            //     "slo" => "sk",
            //     "slv" => "sl",
            //     "sme" => "se",
            //     "smo" => "sm",
            //     "sna" => "sn",
            //     "snd" => "sd",
            //     "som" => "so",
            //     "sot" => "st",
            //     "spa" => "es",
            //     "alb" => "sq",
            //     "srd" => "sc",
            //     "srp" => "sr",
            //     "ssw" => "ss",
            //     "sun" => "su",
            //     "swa" => "sw",
            //     "swe" => "sv",
            //     "tah" => "ty",
            //     "tam" => "ta",
            //     "tat" => "tt",
            //     "tel" => "te",
            //     "tgk" => "tg",
            //     "tgl" => "tl",
            //     "tha" => "th",
            //     "tib" => "bo",
            //     "tir" => "ti",
            //     "ton" => "to",
            //     "tsn" => "tn",
            //     "tso" => "ts",
            //     "tuk" => "tk",
            //     "tur" => "tr",
            //     "twi" => "tw",
            //     "uig" => "ug",
            //     "ukr" => "uk",
            //     "urd" => "ur",
            //     "uzb" => "uz",
            //     "ven" => "ve",
            //     "vie" => "vi",
            //     "vol" => "vo",
            //     "wel" => "cy",
            //     "wln" => "wa",
            //     "wol" => "wo",
            //     "xho" => "xh",
            //     "yid" => "yi",
            //     "yor" => "yo",
            //     "zha" => "za",
            //     "chi" => "zh",
            //     "zul" => "zu",
            // // undecided
            // "und" => "und",
            // // No linguistic content; Not applicable
            // "zxx" => "und",
            // // not applicable
            // "N/A" => "und",
            // // Middle English (1100–1500)
            // "enm" => "en",
            // // Ancient Greek (to 1453)
            // "grc" => "el",
            // // Central American Indian languages
            // "cai" => "und",
            // // multiple
            // "mul" => "und",
            // // Old English (ca. 450–1100)
            // "ang" => "en",
            // // Dakota
            // "dak" => "und"
        ];
        if (isset($languageCodes[$key])) {
            return $languageCodes[$key];
        } else {
            return "und";
        }
    }

    /**
     * @param $baseUrl string this is the base url of the website
     * @param $counter this is the number of sitemaps we assume we follow the same convention
     */
    static function writeXMLSitemapIndex($baseUrl, $counter)
    {
        $siteMapIndex = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');
        for($i = 0; $i < $counter; $i++) {
            $siteMapIndexElement = $siteMapIndex->addChild('sitemap');
            $siteMapIndexElement->addChild('loc', $baseUrl .'bibliographysitemap' . $i . '.xml');
            $siteMapIndexElement->addChild('lastmod', date('Y-m-dTh:m', time()));
        }
        //Format XML to save indented tree rather than one line
        $dom = new DOMDocument();
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($siteMapIndex->asXML());
        //Save XML to file - remove this and following line if save not desired
        $dom->save('bibliographysitemapindex' . '.xml');
    }

}
