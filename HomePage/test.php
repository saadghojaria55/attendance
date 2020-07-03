<?php

include('../commons/connection.php');


	$studentID = "haris";

	$regex = '/[^a-zA-Z\s0-9_.]/';
	$hasAspecialCharacter  = preg_match($regex,$studentID); 

	if ($hasAspecialCharacter) {

		echo "is-invalid";

	}

?>