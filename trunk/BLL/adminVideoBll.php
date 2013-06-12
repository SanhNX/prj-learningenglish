<?php
	$file = fopen("../data-video/2.json","w+") or exit("Unable to open file!");
    fwrite($file,$_POST['content']);
    fclose($file);
    echo true;
?>