<?php
	function file_to_table($path) : String {
		$file = fopen($path, "r");
		
		$table = "";
		
		while(($line = fgets($file)) !== false) {
			list($left, $right) = explode("=", $line);
			$table .= "<tr><td>$left</td><td>$right</td></tr>";
		}
			
		return $table;
	}
?>
