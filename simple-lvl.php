<?php
define('PUBLIC_KEY','YOUR PUBLIC KEY HERE');
define('PACKAGE_NAME','YOUR PACKAGE NAME HERE');

//Will return false if checks fail. Returns the parts of response in an array if all goes well.
//[0] Complete response string.
//[1] Licence Status (0=Licenced)
//[2] Nonce
//[3] App Version Code
//[4] User ID
//[5] Timestamp of the request
//[6] *Retry Count
//[7] *Validity Timestamp
//[8] *Retry Timestamp
//6, 7 and 8 may be blank in test responses.

function processResponse($responseData,$signature){
	if (preg_match('/([\d])\|([\d-]+?)\|'.PACKAGE_NAME.'\|([\d]{1,2}?)\|(.+?)\|([\d-]+)(?::GR=([\d-]+?)&VT=([\d-]+?)&GT=([\d-]+))?/',$responseData,$regs)){
		$key=openssl_get_publickey("-----BEGIN PUBLIC KEY-----\n".chunk_split(PUBLIC_KEY,64,"\n").'-----END PUBLIC KEY-----');
		if(false===$key){return false;}
		if(openssl_verify($responseData,base64_decode($signature),$key,OPENSSL_ALGO_SHA1)){return $regs;}else{return false;}
	}
	return false;
}
?>