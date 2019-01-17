<?php

namespace Creationshop;

/**
* 
*/
class Invoice 
{

	private $apiHandler;
	private $paymentMethod;
	private $currency;
	private $amount;
	private $quantity;
	private $description;
	private $buyerEmail;
	private $browserRedirect;
	private $notes;
	private $link;
	
	public function __construct()
	{
		$this->apiHandler = Creationshop::getApiHandler();
	}


	public function getInvoice($invoiceId=''){
		$url='';
		if($invoiceId){
			$url ="invoices/list/".$invoiceId;
		}else{
			$url ="invoices/list";
		}
		$response = $this->apiHandler->performRequest($url,'GET');
		return $response;
	}

	public function createInvoice(){

		$response = $this->apiHandler->performRequest('invoices/create','POST',$this->serializeJSON());
		
		if($response['success']==true){
			$this->link = $response['link'];
		}
		$result['link'] = $response['link'];
		return $result;
	}

	public function serializeJSON(){
		$invoice=[
			'amount' 		=> $this->amount,
			'quantity'  	=> $this->quantity,
			'buyerEmail'    => $this->buyerEmail,
			'currency' 		=> $this->currency,
			'description'   => $this->description,
			'notes' 		=> $this->notes,
			'browserRedirect'=> $this->browserRedirect,
		];

		return $invoice;
	}

	public function getAmount(){

		return $this->amount;
	}
	public function setAmount($amount){

		return $this->amount = $amount ;
		
	}

	public function getQuantity(){

		return $this->quantity;
	}
	public function setQuantity($quantity){

		return $this->quantity = $quantity ;
		
	}

	public function getBuyerEmail(){

		return $this->buyerEmail;
	}

	public function setBuyerEmail($buyerEmail){

		return $this->buyerEmail = $buyerEmail;

	}


	public function getPaymentMethod(){

		return $this->paymentMethod;
	}

	public function setPaymentMethod($paymentMethod){

		return $this->paymentMethod=$paymentMethod;
	}

	public function getCurrency(){

		return $this->currency;
	}

	public function setCurrency($currency){

		return $this->currency=$currency;
	}

	public function getdescription(){

		return $this->description;
	}

	public function setdescription($description){

		return $this->description=$description;
	}


	public function getNotes(){

		return $this->notes;
	}

	public function setNotes($notes){

		return $this->notes=$notes;
	}

	public function getbrowserRedirect(){

		return $this->browserRedirect;
	}

	public function setbrowserRedirect($browserRedirect){

		return $this->browserRedirect=$browserRedirect;
	}

}
?>