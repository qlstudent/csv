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

// CREATE TABLE studentdb.xmlsitemap 
// ( `id` varchar(32) NOT NULL DEFAULT '' 
// COMMENT 'Primary key with type. a unique id for the item.', 
// `type` varchar(32) NOT NULL DEFAULT '' 
// COMMENT 'Primary key with id. the type of item (e.g. node, user, etc.).', 
// `subtype` varchar(128) NOT NULL DEFAULT '' 
// COMMENT 'A sub-type identifier for the link 
// (node type, menu name, term VID, etc.).', 
// `loc` varchar(255) NOT NULL DEFAULT '' 
// COMMENT 'The URL to the item relative to the Drupal path.', 
// `language` varchar(12) NOT NULL DEFAULT '' 
// COMMENT 'The languages.language of this link 
// or an empty string if it is language-neutral.', 
// `access` tinyint(4) NOT NULL DEFAULT '1' 
// COMMENT 'A boolean that represents if the item is viewable by the anonymous user. 
// This field is useful to store the result of node_access() 
// so we can retain changefreq and priority_override information.', 
// `status` tinyint(4) NOT NULL DEFAULT '1' 
// COMMENT 'An integer that represents if the item is included in the sitemap.', 
// `status_override` tinyint(4) NOT NULL DEFAULT '0' 
// COMMENT 'A boolean that if TRUE means that 
// the status field has been overridden from its default value.', 
// `lastmod` int(10) unsigned NOT NULL DEFAULT '0' 
// COMMENT 'The UNIX timestamp of last modification of the item.', 
// `priority` float DEFAULT NULL 
// COMMENT 'The priority of this URL relative to other URLs on your site. 
// Valid values range from 0.0 to 1.0.', 
// `priority_override` tinyint(4) NOT NULL DEFAULT '0' 
// COMMENT 'A boolean that if TRUE means that 
// the priority field has been overridden from its default value.', 
// `changefreq` int(10) unsigned NOT NULL DEFAULT '0' 
// COMMENT 'The average time in seconds between changes of this item.', 
// `changecount` int(10) unsigned NOT NULL DEFAULT '0' 
// COMMENT 'The number of times this item has been changed. 
// Used to help calculate the next changefreq value.', 
// PRIMARY KEY (`id`,`type`,`language`), 
// KEY `loc` (`loc`(191)), 
// KEY `access_status_loc` (`access`,`status`,`loc`(191)), 
// KEY `type_subtype` (`type`,`subtype`) ) 
// ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 
// COMMENT='The base table for xmlsitemap links.' ;

// MariaDB [studentdb]> describe studentdb.xmlsitemap;
// --------------
// describe studentdb.xmlsitemap
// --------------

// +-------------------+------------------+------+-----+---------+-------+
// | Field             | Type             | Null | Key | Default | Extra |
// +-------------------+------------------+------+-----+---------+-------+
// | id                | varchar(32)      | NO   | PRI |         |       |
// | type              | varchar(32)      | NO   | PRI |         |       |
// | subtype           | varchar(128)     | NO   |     |         |       |
// | loc               | varchar(255)     | NO   | MUL |         |       |
// | language          | varchar(12)      | NO   | PRI |         |       |
// | access            | tinyint(4)       | NO   | MUL | 1       |       |
// | status            | tinyint(4)       | NO   |     | 1       |       |
// | status_override   | tinyint(4)       | NO   |     | 0       |       |
// | lastmod           | int(10) unsigned | NO   |     | 0       |       |
// | priority          | float            | YES  |     | NULL    |       |
// | priority_override | tinyint(4)       | NO   |     | 0       |       |
// | changefreq        | int(10) unsigned | NO   |     | 0       |       |
// | changecount       | int(10) unsigned | NO   |     | 0       |       |
// +-------------------+------------------+------+-----+---------+-------+
// 13 rows in set (0.00 sec)

$host = '127.0.0.1';
$db   = 'mylocaldb';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::MYSQL_ATTR_LOCAL_INFILE => true,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
$time = microtime(true); // time in Microseconds
// $location = "/Users/student/src/csv/sitemap.csv";
// writeCSV();
// updateCSV($pdo, $location);
// BibID_lang_lastModDate_05_29_18a.csv
// var_dump(MyCSV::getUnixTimestamp("08/28/2014"));
// $input = MyCSV::readInputFile("input.csv");
// $input1 = MyCSV::readInputFile("large.csv");
$input1 = MyCSV::readInputFile("BibID_lang_lastModDate_05_29_18a.csv");
MyCSV::writeToDatabase($input1[0], $input1[1], $input1[2], $pdo, true);
// $input2 = MyCSV::readInputFile("/Users/student/src/csv/BibID_lang_lastModDate_05_29_18a.csv");
// MyCSV::writeToDatabase($input2[0], $input2[1], $input2[2], $pdo, false);
// var_dump(MyCSV::getIso6391from6392("eng"));
echo (microtime(true) - $time) . ' elapsed';
