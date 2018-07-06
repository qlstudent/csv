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


//$input = MyCSV::readInputFile("smallinput.csv");
$input = MyCSV::readInputFile("input.csv");
//$input = MyCSV::readInputFile("tinyinput.csv");
MyCSV::writeXMLSitemap($input[0], $input[2]);
