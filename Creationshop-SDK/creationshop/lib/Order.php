<?php
namespace Creationshop;
/**
* 
*/
use Creationshop\PaymentMethod;
class Order
{

	private $apiHandler;
	private $amount;
	private $buyerEmail;
	private $buyerIp;
	private $paymentMethod;
	private $currency;
	private $notes;
	private $paymentInsructions;

		
	public function __construct()
	{
		$this->apiHandler = Creationshop::getApiHandler();
	}
	
	
	public function getOrders($orderId=''){
		$url='';
		if($orderId){
			$url ="orders/list/".$orderId;
		}else{
			$url ="orders/list";
		}
		$response = $this->apiHandler->performRequest($url,'GET');
		return $response;
	}


	public function createOrder(){

		$response = $this->apiHandler->performRequest('orders/create','POST',$this->serializeJSON());
		if($response['success']==true){
			$this->paymentInsructions = $response['paymentInstruction'];
		}
		$result['paymentInstruction'] = $response['paymentInstruction'];
		return $result;
	}

	public function serializeJSON(){
		$order=[

			'amount' 	    => $this->amount,
			'buyerEmail'    => $this->buyerEmail,
			'buyerIp'    	=> $this->buyerIp,
			'paymentMethod' => $this->paymentMethod,
			'currency' 		=> $this->currency,
			'notes' 		=> $this->notes,
		];

		return $order;
	}


	public function getAmount(){

		return $this->amount;
	}
	public function setAmount($amount){

		return $this->amount = $amount ;
		
	}

	public function getBuyerEmail(){

		return $this->buyerEmail;
	}

	public function setBuyerEmail($buyerEmail){

		return $this->buyerEmail = $buyerEmail;

	}

	public function getBuyerIp(){

		return $this->buyerIp;
	}

	public function setBuyerIp($buyerIp){

		return $this->buyerIp = $buyerIp;

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

	public function getNotes(){

		return $this->notes;
	}

	public function setNotes($notes){

		return $this->notes=$notes;
	}
}
?>