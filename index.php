<?php 
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="sitemap.csv"');
$locations = ["/bib/1", "/bib/2", "/bib/3", "/bib/4", "/bib/5"];
$priority = "0.5";
$sravan = array();
foreach($locations as $location){
    $sravan[] = $location . "," . $priority . ",potato,tomato";
}

$fp = fopen('php://output', 'w');
foreach ( $sravan as $line ) {
    $val = explode(",", $line);
    fputcsv($fp, $val);
}
fclose($fp);
