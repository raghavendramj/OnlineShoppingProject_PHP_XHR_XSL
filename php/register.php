<?php
$filenamePath = '' . $_GET['xmlPath'] . 'customer.xml';
$last = 0;
if (! file_exists($filenamePath)) {
    
    $newXML = new SimpleXMLElement("<customers></customers>");
    $newIntro = $newXML->addChild("customer");
    $newIntro->addChild('customerid', '1');
    $newIntro->addChild('firstname', $_GET['firstname']);
    $newIntro->addChild('lastname', $_GET['lastname']);
    $newIntro->addChild('email', $_GET['email']);
    $newIntro->addChild('password', $_GET['password']);
    $newIntro->addChild('phonenumber', $_GET['phoneNumber']);
    Header('Content-type: text/xml');
    $newXML->asXML($filenamePath);
    echo 'success';
    $last = 1;
} else {
    $xml = simplexml_load_file($filenamePath);
    foreach ($xml as $item) {
        $last = $item->customerid;
        if (strcasecmp($item->email, $_GET['email']) == 0) {
            echo '<p><b>Error: ' . $_GET['email'] . ' is already registered. Please provide unique email address</b></p>';
            exit();
        }
    }
    $last = $last + 1;
    
    $xml = simplexml_load_file($filenamePath);
    $sxe = new SimpleXMLElement($xml->asXML());
    $person = $sxe->addChild("customer");
    $person->addChild('customerid', $last);
    $person->addChild('firstname', $_GET['firstname']);
    $person->addChild('lastname', $_GET['lastname']);
    $person->addChild('email', $_GET['email']);
    $person->addChild('password', $_GET['password']);
    $person->addChild('phonenumber', $_GET['phoneNumber']);
    $sxe->asXML($filenamePath);
    echo 'success';
}
?>

