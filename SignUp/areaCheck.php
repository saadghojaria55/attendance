<?php

$Western = "Andheri
Bandra
Borivali
Dahisar
Mira Road
Goregaon
Jogeshwari
Juhu
Khar
Malad
Santacruz
Vile Parle";


$Eastern = "Bhandup
Ghatkopar
Kanjurmarg
Kurla
Mulund
Powai
Vidyavihar
Vikhroli";


$Harbour = "Chembur
Govandi
Mankhurd
Trombay";


$South = "Churchgate
Cotton Green
Cuffe Parade
Currey Road
Dongri
Lalbaug
Lower Parel
Mahalaxmi
Mahim
Malabar Hill
Marine Lines
Mumbai Central
Nariman Point
Sion
Worli
Antlop Hill
Byculla
Colaba
Dadar
Fort
Girgaon
Kalbadevi
Kamathipura
Matunga
Parel
Tardeo";


$Other = "Bori Bunder
Dharavi
Kajuwadi
Koliwada
Koombarwara";


	if (isset($_REQUEST['precinct'])) {
		$precinct = $_REQUEST['precinct'];

		switch ($precinct) {
			case 'Western':
				$areaArray = explode("
", $Western);
				break;
			case 'Eastern':
				$areaArray = explode("
", $Eastern);
				break;
			case 'Harbour':
				$areaArray = explode("
", $Harbour);
				break;
			case 'South':
				$areaArray = explode("
", $South);
				break;
			case 'Other':
				$areaArray = explode("
", $Other);
				break;
		}


		if ($precinct != "Select Area") {
            echo "<option selected>Select Area</option>";
			foreach ($areaArray as $key => $val) {
				echo "<option value='$val'>".$val."</option>";	
			}
		}
	}
