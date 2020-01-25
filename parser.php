<?php
$_countryCode=file_get_contents("countryCode.json");
$_countryCode=json_decode($_countryCode, true);
// print_r($_countryCode);
$countryCode=[];
foreach($_countryCode as $item) {
	$countryCode[$item["code"]]=$item["name"];
}
print_r($countryCode);
$_cityData=file_get_contents("cityData.json");
$_cityData=json_decode($_cityData, true);
// print_r($_cityData);
$cities=[];
foreach($_cityData as $item) {
	// $cities[$item["country"]][]=[
	// 	$item["name"],
	// 	$item["population"]
	// ];
	$country[$item["country"]][]=[
		$countryCode[$item["country"]] . ", " . $item["name"] ." (".$item["country"] . ")",
		$item["population"]
	];
	$cities[]=[
		$countryCode[$item["country"]] . ", " . $item["name"] ." (".$item["country"] . ")",
		$item["population"]
	];
}
// print_r($cities);
file_put_contents("result.json", json_encode($cities));
foreach($country as $name=>$item) {
	file_put_contents("countryCode/".$name. ".json", json_encode($item));
	file_put_contents("countryName/".$countryCode[$name]. ".json", json_encode($item));
}
/////////////////////
$cities=[];
foreach($_cityData as $item) {
	$country[$item["country"]][]=[
		$countryCode[$item["country"]], $item["name"], $item["country"], $item["population"]
	];
	$cities[]=[
		$countryCode[$item["country"]], $item["name"], $item["country"], $item["population"]
	];
}
file_put_contents("cleanResult.json", json_encode($cities));
foreach($country as $name=>$item) {
	file_put_contents("cleanCountryCode/".$name. ".json", json_encode($item));
	file_put_contents("cleanCountryName/".$countryCode[$name]. ".json", json_encode($item));
}
