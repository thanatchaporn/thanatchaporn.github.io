<?php

$getText = null;
$value =null;
$prov_list = null;
$pic_list = null;

$prov_77 = fopen("77province.txt", "r") or die("Unable to open file!");
$read_prov = fread($prov_77,filesize("77province.txt"));
$prov_array = explode(PHP_EOL, $read_prov);
$indexPic = 1;

foreach ($prov_array as $key => $value) {
	$prov_name = explode(",", $value);
	$prov_list[$prov_name[0]] = $prov_name[1];
    $pic_list[$prov_name[0]] = "sign/".$indexPic.".png";
    $indexPic++;
}


fclose($prov_77);


if ($_POST["age"] <= "13") {
    $getText[0] = "Hello Kids (^_^)/";
    $getText[1] = "kidsBG.jpg";
    $getText[2] =  $prov_list[$_POST["province"]];
    $getText[3] = "Comic Sans MS";
    $getText[4] = $pic_list[$_POST["province"]];
}elseif ($_POST["gender"] == "female") {
    $getText[0] = "Hello Lady";
    $getText[1] = "female.jpg";
    $getText[2] =  $prov_list[$_POST["province"]];
    $getText[3] = "Georgia";
    $getText[4] = $pic_list[$_POST["province"]];
} elseif ($_POST["gender"] == "male") {
    $getText[0] = "Hello Gantleman";
    $getText[1] = "male.jpg";
    $getText[2] =  $prov_list[$_POST["province"]];
    $getText[3] = "Helvetica";
    $getText[4] = $pic_list[$_POST["province"]];
}
echo json_encode($getText);


?>

