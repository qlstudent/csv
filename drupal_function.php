<?php 
/**
 * this is only a scratch file 
 * this will not work 
 * please don't run this script 
 */

function writeCSV() 
{
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="sitemap.csv"');
    //$locations = ["/bib/1", "/bib/2", "/bib/3", "/bib/4", "/bib/5"];
    $locations = array();
    $starting = 10001;
    $ending = 15000;
    for ($i = $starting; $i <= $ending; $i++) {
        $locations[] = "/bib/" . $i;
    }
    $id = $starting;
    $type ="custom";
    $subtype ="";
    $language = "en";
    $access = 1;
    $status = 1;
    $status_override = 0;
    $lastmod = time(); 
    $priority = "0.5";
    $priority_override = 0;
    $changefreq = "86400";
    $changecount = 0;
    $sravan = array();
    foreach ($locations as $location) {
        $lastmod = time();
        $sravan[] = $id . "," . $type . "," . $subtype . "," . $location . "," . $language 
        . "," . $access . "," . $status . "," . $status_override . "," . $lastmod . "," 
        . $priority . "," . $priority_override . "," . $changefreq . "," . $changecount;
        $id += 1;
    }

    $fp = fopen('php://output', 'w');
    fputcsv($fp, explode(",", "id,type,subtype,location,language,access,status,status_override,lastmod,priority,priority_override,changefreq,changecount"));
    foreach ( $sravan as $line ) {
        $val = explode(",", $line);
        fputcsv($fp, $val);
    }
    fclose($fp);
}

function updateCSV($pdo, $uploadfile) 
{
    echo "Hello, world!";
    $delete_statement = "delete from xmlsitemap where type = 'custom'";
    $pdo->exec($delete_statement);
    // LOAD DATA LOCAL INFILE '/home/kus/src/php/csv/sitemap.csv' INTO TABLE studentdb.xmlsitemap FIELDS TERMINATED BY ',' ignore 1 lines;
    $statement = "LOAD DATA LOCAL INFILE '" . $uploadfile . "' INTO TABLE `xmlsitemap` FIELDS TERMINATED BY ',' ignore 1 lines";
    $statement = $pdo->exec($statement);
    echo "query done";
}

function getUnixTimestamp($stringDate): int
{    
    return strtotime($stringDate);
}

function readInputFile($inputFileName) 
{
    $row = 1;
    $locations = array();
    if (($handle = fopen($inputFileName, "r")) !== false) {
        // ignore the first line 
        $data = fgetcsv($handle, 0, ",");
        while (($data = fgetcsv($handle, 0, ",")) !== false) {
            $num = count($data);
            // echo "<p> $num fields in line $row: <br /></p>\n";
            for ($c=0; $c < $num; $c++) {
                // echo $data[$c] . "<br />\n";
                if ($c == 0) {
                    array_push($locations, $data[$c]);
                }
            }
            $row++;
        }
        fclose($handle);
    }
    return $locations;
}
