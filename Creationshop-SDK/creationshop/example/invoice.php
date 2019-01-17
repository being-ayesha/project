<?php
require_once realpath(__DIR__ . '/../') . '/init.php';
 /**
 * 
 */

	// Set API Crediential 
 		
 	//\Creationshop\Creationshop::setApiHandler('APIID','APISECRET');
	
	\Creationshop\Creationshop::setApiHandler('creationshopGkl0j1s6qv4fI2SYWihxU9QgFTwcDo','enJBdlBobE10d0RieWlHS2FvTkY2MnE3akNYMFlXY0xkZm1JU244OTN1VFJVMWtlSHg=');

	//Get Invoice List
	$i = new Creationshop\Invoice();
	print_r($i->getInvoice());exit();
	//print_r($i->getInvoice('WRFXTCDYGWYR'));exit();

 	
 	
    $i = new Creationshop\Invoice();
 	$i->setAmount(10);
 	$i->setQuantity(1);
 	$i->setBuyerEmail('aminul.techvill@gmail.com');
 	$i->setPaymentMethod(1);
 	$i->setCurrency(1);
 	$i->setbrowserRedirect('https://hrm.techvill.net');
 	$result = $i->createInvoice();
	//print_r($result);exit();
 	echo "Please visit click the following link to pay the invoice: " . $result['link']. "\n";

?>