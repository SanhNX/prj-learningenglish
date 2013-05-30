<?php

//$headers = array('http'=>array('method'=>'GET','header'=>'Content: type=application/json \r\n'.'$agent \r\n'.'$hash'));
//
//$context=stream_context_create($headers);
//
//$str = file_get_contents("../data-video/47.json",FILE_USE_INCLUDE_PATH,$context);
//
//$str=utf8_encode($str);
//
//$str=json_decode($str,true);
//
//print_r($str);

$string = file_get_contents("../data-video/47.json");
$json_a=json_decode($string,true);
//echo  $json_a['rows'][1][caption_text];
echo  count($json_a['rows']);

//echo $_POST['answer'][0] .'---'.count($_POST['answer']) ;

?>

