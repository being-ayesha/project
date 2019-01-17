<?
namespace Creationshop;
/**
* 
*/
class ApiHandler
{

	private $baseUrl;
	private $applicationId;
	private $applicationSecret;
	
	function __construct($applicationId, $applicationSecret)
	{
		$this->baseUrl = 'http://aminul-pc/rocketr/api/';
		$this->applicationId =  $applicationId;
		$this->applicationSecret = $applicationSecret;
	}

	public function performRequest($url,$method, $postData='',$headers=''){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->baseUrl . $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);

		if(strtoupper($method)=="POST"){
            curl_setopt($ch,CURLOPT_POST,true);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$postData);
        }
        if(strtoupper($method)=="GET"){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge([
							'ApplicationId: ' .$this->applicationId,
							'Authorization: ' . $this->applicationSecret,
							'header:'.$headers
						]));

        $result = curl_exec($ch);
        $error_msg='';
        if (curl_error($ch)) {
        	$error_msg = curl_error($ch);
        }
        curl_close($ch);
        print_r($error_msg);
        $resultArray = json_decode($result, true);
        return $resultArray;
	}

	
}
?>