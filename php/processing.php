<?php
   header('Content-Type: text/xml');
   $xmlDoc = new DomDocument("1.0");
   $filenamePath = '' . $_GET['xmlPath'] . 'goods.xml';
   processGoods($filenamePath);
   
   $xmlDoc->load($filenamePath);
   $xslDoc = new DomDocument("1.0");
   
   $xslDoc->load("../xsl/processingGoods.xsl"); 
   $proc = new XSLTProcessor; 
   $proc->importStyleSheet($xslDoc); 
   echo $proc->transformToXML($xmlDoc); 
   
   function processGoods()
   {
       $filenamePath = '' . $_GET['xmlPath'] . 'goods.xml';
       $sxe = new SimpleXMLElement($xml->asXML());
       foreach ($xml as $item) 
       {
           echo (int)$item->quantityavailable."<br />";
           echo (int)$item->quantitysold."<br />";
           
           if((int)$item->quantityavailable == 0 && (int)$item->quantitysold == 0){
               $sxe->removeChild($item);
               $xml->asXML($filenamePath);
           }
               
       }
       
   }
   
?>