<?php
require_once realpath(__DIR__ . '/../') . '/init.php';
 /**
 * 
 */

	// Set API Crediential 
 		
 	//\Creationshop\Creationshop::setApiHandler('APIID','APISECRET');
	
	\Creationshop\Creationshop::setApiHandler('creationshopGkl0j1s6qv4fI2SYWihxU9QgFTwcDo','enJBdlBobE10d0RieWlHS2FvTkY2MnE3akNYMFlXY0xkZm1JU244OTN1VFJVMWtlSHg=');

	//Get Order List
		//$o = new Creationshop\Order();
		//print_r($o->getOrders());exit();

 	//Get Order Details

      // $o = new Creationshop\Order();
		//print_r($o->getOrders('dasdas'));exit(); 
 	
    $o = new Creationshop\Order();
 	$o->setAmount(50);
 	$o->setBuyerEmail('atik@gmail.com');
 	$o->setPaymentMethod(1);
 	$o->setCurrency(1);
 	$result = $o->createOrder();

 	echo 'Please send  Amount:' . $result['paymentInstruction']['amount']  .'Currency:'. $result['paymentInstruction']['currency'] . ' to ' . $result['paymentInstruction']['link'];
 	

?>