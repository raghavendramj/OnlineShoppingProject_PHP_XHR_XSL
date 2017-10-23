<?php


function updateGoodsXML($filenamePath)
{
    if (! file_exists($filenamePath)) {
        createNewXMLAndData($filenamePath);
    } else {
        addNewEntryToXML($filenamePath);
    }
}

function createNewXMLAndData($filenamePath)
{
    $newXML = new SimpleXMLElement("<goods></goods>");
    
    Header('Content-type: text/xml');
    $newXML->asXML($filenamePath);
    
    addNewEntryToXML($filenamePath);
}

function addNewEntryToXML($filenamePath)
{
    $xml = simplexml_load_file($filenamePath);
    $lastNumber = 0;
    foreach ($xml as $item)
        $lastNumber = $item->itemnumber;
    
    $lastNumber = $lastNumber + 1;
    
    $currentXML = new SimpleXMLElement($xml->asXML());
    
    $newItem = $currentXML->addChild("item");
    
    $newItem->addChild('itemnumber', $lastNumber);
    $newItem->addChild('itemname', $_GET['itemname']);
    $newItem->addChild('price', $_GET['itemprice']);
    $newItem->addChild('description', $_GET['description']);
    $newItem->addChild('quantityavailable', $_GET['itemquantity']);
    $newItem->addChild('quantityonhold', 0);
    $newItem->addChild('quantitysold', 0);
    
    $currentXML->asXML($filenamePath);
    
    echo 'Thank you!, Your item has been listed in Buy Online Shopping Catalog!.';
}

$filenamePath = '' . $_GET['xmlPath'] . 'goods.xml';

updateGoodsXML($filenamePath);

?>
