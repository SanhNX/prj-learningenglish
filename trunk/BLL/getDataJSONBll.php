<?php

$string = file_get_contents("../data-video/".$_POST['id'].".json");
$data=json_decode($string,true);
//echo  $json_a['rows'][1][caption_text];
echo $string;

?>

