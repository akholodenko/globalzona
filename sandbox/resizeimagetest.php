<?php

	include_once("resizeimage.inc.php");
	$rimg=new RESIZEIMAGE("../test/harish.gif");
	echo $rimg->error();
	$rimg->resize_percentage(50);
	$rimg->close();
?>