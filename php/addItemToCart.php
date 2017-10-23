<?php
$filenamePath = '' . $_GET['xmlPath'] . 'goods.xml';
$xml = simplexml_load_file($filenamePath);
$action = $_GET['action'];
$sxe = new SimpleXMLElement($xml->asXML());
foreach ($xml as $item) {
    if ($item->itemnumber == $_GET['itemnumber']) {
        if (strcasecmp("addToCart", $_GET['action']) == 0) {
            $item->quantityavailable = $item->quantityavailable - 1;
            $item->quantityonhold = $item->quantityonhold + 1;
            echo 'Thank you!.. Your Item has been added to cart!';
        }
        
        if (strcasecmp("removeFromCart", $_GET['action']) == 0) {
            $item->quantityavailable = $item->quantityavailable + 1;
            $item->quantityonhold = $item->quantityonhold - 1;
            echo 'Your Item has been Removed to cart!';
        }
        
        $xml->asXML($filenamePath);
    }
}

?>