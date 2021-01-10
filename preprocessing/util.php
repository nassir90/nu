<?php
	function file_to_table($path) : String {
		$file = fopen($path, "r");
		
		$table = "<!-- Loaded by a php script made by naza :) !--><table>";
		
		while(($line = fgets($file)) !== false) {
			$columns = explode("=", $line);
			
			$table .= "<tr>";
			
			for ($i=0; $i<count($columns); $i++) {
				$table .= "<td>". trim($columns[$i]) . "</td>";
			}
			
			$table .= "</tr>";
		}
		
		return $table . "</table>";
	}
?>
