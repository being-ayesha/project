## CreationShop SDK

## Initialize The Path

- Step 1: require_once realpath(__DIR__ . '/../') . '/init.php';

## Set API Crediential 

- Step 2: \Creationshop\Creationshop::setApiHandler('your_application_id','your_application_secret');

## Get Order List

This endpoint is used to retreive a list of all orders.

	$o = new Creationshop\Order();
	print_r($o->getOrders());

## Get Specific Order Details

This endpoint is used to retreive specific information about an order.

	$o = new Creationshop\Order();
	print_r($o->getOrders('your_orders_id'));

## Order Create 

This will create an invoice and order and return the payment details.


	$o = new Creationshop\Order();
 	$o->setAmount(50);
 	$o->setBuyerEmail('shakil.techvill@gmail.com');
 	$o->setPaymentMethod(1);
 	$o->setCurrency(1);
 	$result = $o->createOrder();

 	echo 'Please send  Amount:' . $result['paymentInstruction']['amount']  .'Currency:'. $result['paymentInstruction']['currency'] . ' to ' . $result['paymentInstruction']['link'];


## Get Invoice List

This endpoint is used to retreive a list of all invoices.

	$i = new Creationshop\Invoice();
	print_r($i->getInvoice());


## Get Invoice Specific Details

This endpoint is used to retreive specific information about an invoices. 

	$i = new Creationshop\Invoice();
	print_r($i->getInvoice('your_invoice_id'));

## Create Invoice

This will create an invoice and respond with the invoice identifier and a link to the checkout page.

	$i = new Creationshop\Invoice();
 	$i->setAmount(10);
 	$i->setQuantity(1);
 	$i->setBuyerEmail('shakil.techvill@gmail.com');
 	$i->setPaymentMethod(1);
 	$i->setCurrency(1);
 	$i->setbrowserRedirect('https://rocketr.techvill.net');
 	$result = $i->createInvoice();
 	echo "Please visit click the following link to pay the invoice: " . $result['link']. "\n";








