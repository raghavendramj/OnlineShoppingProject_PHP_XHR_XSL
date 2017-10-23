<?php
function loginToApplication($filenamePath)
{
    $xml = simplexml_load_file($filenamePath);
    
    $user_validate = false;
    $isUserRegistered = false;
    foreach ($xml as $item) {
        if ($item->password == $_GET['password'])
        {
            $isUserRegistered = true;
            if($item->password == $_GET['password'])
            {
                $_SESSION['email'] = $_GET['email'];
                session_write_close();
                $user_validate = true;
            }
            break;
        }
        else
        {
            
        }
    }
    
    if(!$isUserRegistered)
    {
        echo "Looks like you haven't registered with us, Please click here to register now.";
        echo "<a href='register.htm' target='register.htm'> Register here</a>";
    }
    
    if($user_validate)
        echo 'success';
        else
            echo '<p><strong>Note: </strong>Username/Password does not match</p><br/>';
}

function checkForLoginSession()
{
    echo '<p>' . print_r(session_id) . '</p>';
    echo '<pre>';
    var_dump($_SESSION);
    echo '</pre>';
    if ($_SESSION['email'] == "") {
        error_reporting(E_ALL);
        
        echo "Login Error: User not Logged On Click <a href='login.htm' target='login.htm'> Home </a> to login";
        exit();
    }
    return true;
}

function loadShoppingCatalog($filenamePath, $xslPath)
{
    //checkForLoginSession();
    
    $xml = simplexml_load_file($filenamePath);
    
    header('Content-Type: text/xml');
    $xmlDoc = new DomDocument("1.0");
    
    $xmlDoc->load($filenamePath);
    $xslDoc = new DomDocument("1.0");
    $xslDoc->load($xslPath);
    $proc = new XSLTProcessor();
    $proc->importStyleSheet($xslDoc);
    echo $proc->transformToXML($xmlDoc);
}


function processGoods($filenamePath)
{
    $xmlDoc = new DomDocument("1.0");
    $xmlDoc->load($filenamePath);
    
    $xmlDoc->load($filenamePath);
    foreach ($xmlDoc as $item)
    {
        if((int)$item->quantityavailable == 0 && (int)$item->quantityonhold == 0)
        {
            $item->parentNode->removeChild($item);
        }
        $xml->asXML($filenamePath);
    }
    
}

if (!isset($_SESSION)) {
    session_start();
}

if(strcasecmp("login", $_GET['action']) == 0){
    $filenamePath = '' . $_GET['xmlPath'] . 'customer.xml';
    loginToApplication($filenamePath);
}
    
 if(strcasecmp("laodShoppingCatalog", $_GET['action']) == 0){
     $filenamePath = '' . $_GET['xmlPath'] . 'goods.xml';
     $xslPath = "../xsl/loadShoppingPage.xsl";
     loadShoppingCatalog($filenamePath, $xslPath);
 }
     
 if(strcasecmp("loadProcessingPage", $_GET['action']) == 0){
     $filenamePath = '' . $_GET['xmlPath'] . 'goods.xml';
     $xslPath = "../xsl/processingGoods.xsl";
     processGoods($filenamePath);
     loadShoppingCatalog($filenamePath, $xslPath);
 }
 




?>