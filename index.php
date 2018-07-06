<?php 
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
 * @license    http://www.queenslibrary.org  Proprietary?
 * @version    GIT: $Id$
 * @link       https://www.drupal.org/project/xmlsitemap
 * @see        XMLSitemap
 * @since      File available since May 2018
 * @deprecated Not deprecated 
 */

require 'drupal_function.php';


$input = MyCSV::readInputFile("tinyinput.csv");
//MyCSV::writeCSV($input[0], $input[1], $input[2]);

$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');

for ($i = 1; $i <= 3; ++$i) {
    $url = $xml->addChild('url');
    $url->addChild('loc', "song$i.mp3");
    $url->addChild('changefreq', "weekly");
    $url->addChild('priority', "1.0");
}

//Format XML to save indented tree rather than one line
$dom = new DOMDocument('1.0');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xml->asXML());
//Echo XML - remove this and following line if echo not desired
echo $dom->saveXML();
//Save XML to file - remove this and following line if save not desired
$dom->save('fileName.xml');
