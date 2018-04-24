<?php 
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="sitemap.csv"');
//$locations = ["/bib/1", "/bib/2", "/bib/3", "/bib/4", "/bib/5"];
$locations = array();
for ($i = 1; $i <= 1000000; $i++) {
    $locations[] = "/bib/" . $i;
}
$id = 1;
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
foreach($locations as $location){
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
