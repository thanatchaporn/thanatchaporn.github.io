<?php

$getText = null;
$value =null;

$prov_77 = fopen("77province.txt", "r") or die("Unable to open file!");
$read_prov = fread($prov_77,filesize("77province.txt"));
$prov_array = explode(PHP_EOL, $read_prov);

foreach ($prov_array as $key => $value) {
	$prov_name = explode(",", $value);
	$prov = $prov_name[0];

	if($_POST["province"] === $prov_name[0]){
		$get_prov = $prov_name[1];
		break;
	}

}


fclose($prov_77);


if ($_POST["age"] >= "2004") {
    $getText[0] = "Hello Kids (^_^)/";
    $getText[1] = "kidsBG.jpg";
    $getText[2] =  $get_prov;
}elseif ($_POST["gender"] == "female") {
    $getText[0] = "Hello Lady";
    $getText[1] = "female.png";
    $getText[2] =  $get_prov;
} elseif ($_POST["gender"] == "male") {
    $getText[0] = "Hello Gantleman";
    $getText[1] = "male.jpg";
    $getText[2] =  $get_prov;
}
echo json_encode($getText);


?>

