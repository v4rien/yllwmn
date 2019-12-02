<?php
#AUTO CLAIM VOC GOJEK + tf 1rp 
#MASUKIN AKUN YANG UDAH VERIF 
#Created By Alip Dzikri X Apri AMsyah
#####################################

$secret = '83415d06-ec4e-11e6-a41b-6c40088ab51e';
$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'X-AppVersion: 3.27.0';
$headers[] = "X-Uniqueid: ac94e5d0e7f3f".rand(111,999);
$headers[] = 'X-Location: -6.405821,106.064193';

echo "Nomer HP Akun Utama: ";
$number = trim(fgets(STDIN));
$numbers = $number[0].$number[1];
$numberx = $number[5];
if($numbers == "08") { 
	$number = str_replace("08","628",$number);
}
$login = curl('https://api.gojekapi.com/v3/customers/login_with_phone', '{"phone":"+' . $number . '"}', $headers);
$logins = json_decode($login[0]);
if($logins->success == true) {
	echo "OTP: ";
	$otp = trim(fgets(STDIN));
	$data1 = '{"scopes":"gojek:customer:transaction gojek:customer:readonly","grant_type":"password","login_token":"' . $logins->data->login_token . '","otp":"' . $otp . '","client_id":"gojek:cons:android","client_secret":"' . $secret . '"}';
	$verif = curl('https://api.gojekapi.com/v3/customers/token', $data1, $headers);
	$verifs = json_decode($verif[0]);
	if($verifs->success == true) {
		$token = $verifs->data->access_token;
		echo "Token: ".$token;
		echo "\n";
		echo "\n";
	} else {
		die("OTP salah goblok!");
	}
} else {
	die("ERROR - Nomer belum kedaftar goblok / Tunggu 15 Menit");
}
		
		// Verif OTP
		if($regs->success == true) {
			echo "[+] OTP: ";
			$otp = trim(fgets(STDIN));
			$data2 = '{"client_name":"gojek:cons:android","data":{"otp":"' . $otp . '","otp_token":"' . $regs->data->otp_token . '"},"client_secret":"' . $secret . '"}';
			$verif = curl('https://api.gojekapi.com/v5/customers/phone/verify', $data2, $headers);
			$verifs = json_decode($verif[0]);
			if($verifs->success == true) {
		
