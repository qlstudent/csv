<?php 
  /**
   * this is only a scratch file 
   * this will not work 
   * please don't run this script 
   */
  function updateCSV($uploadfile) {
    $connection = \Drupal::database();
    $deleteExisting = $connection->query("delete from table `xmlsitemap` where type='custom'");
    $deleteExisting->execute();
    $result = $connection->query("LOAD DATA INFILE '" . $uploadfile . "' INTO TABLE `xmlsitemap` FIELDS TERMINATED BY ',' (id,type,subtype,location,language,access,status,status_override,lastmod,priority,priority_override,changefreq,changecount)");
    $result->execute();
  }