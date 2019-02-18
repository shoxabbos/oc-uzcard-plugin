<?php namespace Shohabbos\Uzcard\Classes;


class Helper
{
 
	public static function send($data) {
		$payload = json_encode($data);
		 
		// Prepare new cURL resource
		$ch = curl_init('http://195.158.28.125:9099/api/payment/PaymentsWithOutRegistration');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		 
		// Set HTTP Header for POST request 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Content-Type: application/json',
		    'Content-Length: ' . strlen($payload))
		);
		 
		// Submit the POST request
		$result = curl_exec($ch);
		 
		// Close cURL session handle
		curl_close($ch);

		return $result;
	}

}
