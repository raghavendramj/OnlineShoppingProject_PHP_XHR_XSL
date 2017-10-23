<?php
function purchaseItems($filenamePath)
{
    $confirm = strcasecmp("confirmPurchase", $operation == 0);
    $selectedItemsArray = explode(',', $_GET['itemIds']);
    
    foreach($selectedItemsArray as $currentItemNumber)
    {
        if($confirm)
            confirmPurchase($filenamePath, $currentItemNumber);
        else 
            cancelPurchase($filenamePath, $currentItemNumber);
    }
    echo "success";
}

function confirmPurchase($filenamePath, $currentItemNumber)
{
    list ($itemNumber, $itemQuantity) = explode('-', $currentItemNumber);
    $intItemNumber = (int)$itemNumber;
    $intItemQuamtity = (int)$itemQuantity;
    $xml = simplexml_load_file($filenamePath);
    foreach ($xml as $item)
    {
        if ($item->itemnumber == $intItemNumber)
        {
            $item->quantityavailable = $item->quantityavailable -$intItemQuamtity;
            $item->quantityonhold = $item->quantityonhold - $intItemQuamtity;
            $item->quantitysold = $item->quantitysold + $intItemQuamtity;
            break;
            
        }
    }
    $xml->asXML($filenamePath);
}

function cancelPurchase($filenamePath, $currentItemNumber)
{
    list ($itemNumber, $itemQuantity) = explode('-', $currentItemNumber);
    $intItemNumber = (int)$itemNumber;
    $intItemQuamtity = (int)$itemQuantity;
    $xml = simplexml_load_file($filenamePath);
    foreach ($xml as $item)
    {
        if ($item->itemnumber == $intItemNumber)
        {
            $item->quantityavailable = $item->quantityavailable + 1;
            $item->quantityonhold = $item->quantityonhold - 1;
            break;
        }
    }
    $xml->asXML($filenamePath);
}
    

function updateXML($filenamePath, $currentItemNumber, $operation)
{
    echo $currentItemNumber ."<br />";
    list ($itemNumber, $itemQuantity) = explode('-', $currentItemNumber);
    $intItemNumber = (int)$itemNumber;
    $intItemQuamtity = (int)$itemQuantity;
    
    $xml = simplexml_load_file($filenamePath);
    foreach ($xml as $item) {
        if ($item->itemnumber == $intItemNumber) 
        {
            if (strcasecmp("confirmPurchase", $operation == 0))
            {
                $item->quantityavailable = $item->quantityavailable - 1;
                $item->quantityonhold = $item->quantityonhold - 1;
                $item->quantitysold = $item->quantitysold + 1;
            }
            
            if (strcasecmp("cancelPurchase", $operation == 0)) 
            {
                $item->quantityavailable = $item->quantityavailable + 1;
                $item->quantityonhold = $item->quantityonhold - 1;
            }
            $xml->asXML($filenamePath);
            break;
        }
    }
}

$filenamePath = '' . $_GET['xmlPath'] . 'goods.xml';
purchaseItems($filenamePath);

?>
