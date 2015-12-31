<?php header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');
$paramTrendID=$_GET['paramTrendID'];

$strFileName = "fileTrend/trendJson-$paramTrendID.txt";
$objFopen = fopen($strFileName, 'r');
if ($objFopen) {
    while (!feof($objFopen)) {
        $file = fgets($objFopen, 4096);
        echo $file;
    }
    fclose($objFopen);
}
?>
