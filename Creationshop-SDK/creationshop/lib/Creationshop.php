<?php

namespace Creationshop;

/**
* 
*/

use Creationshop\ApiHandler;

class Creationshop
{

	public static $applicationId;
	public static $applicationSecret;
	public static $apiHandler;

	public static function setApiHandler($applicationId, $applicationSecret){

		self::$applicationId     = $applicationId;
		self::$applicationSecret = $applicationSecret;
		self::$apiHandler        = new ApiHandler($applicationId, $applicationSecret);
		
	}

	public static function getApiHandler(){
		self::$apiHandler = new ApiHandler(self::$applicationId, self::$applicationSecret);
		return self::$apiHandler;
	}
	
	
}
?>