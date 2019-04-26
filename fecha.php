<?php
	$fecha = getdate();
	print_r($fecha['mday'].' de '.convertirmes($fecha['mon']).' de '.$fecha['year']);
	//print_r($fecha);
?>