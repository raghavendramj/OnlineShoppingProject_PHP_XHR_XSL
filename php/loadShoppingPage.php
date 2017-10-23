<?php
session_start();
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
error_reporting(0);
if ($_SESSION['email'] == "") {
    error_reporting(E_ALL);
    echo "Login Error: User not Logged On Click <a href='login.htm' target='login.htm' >Home</a> to login";
    exit();
}
error_reporting(E_ALL);

$filenamePath = '' . $_GET['xmlPath'] . 'goods.xml';
$xml = simplexml_load_file($filenamePath);

foreach ($xml as $item) {
    // echo $item->itemname.' :: Avail : '.$item->quantityavailable. "<br \>";
    // echo $item->itemname.' :: On Hold : '.$item->quantityonhold. "<br \>";
}

header('Content-Type: text/xml');
$xmlDoc = new DomDocument("1.0");

$xmlDoc->load($filenamePath);
$xslDoc = new DomDocument("1.0");
$xslDoc->load("../xsl/loadShoppingPage.xsl");
$proc = new XSLTProcessor();
$proc->importStyleSheet($xslDoc);
echo $proc->transformToXML($xmlDoc);
?>