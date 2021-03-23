<?php
	function file_to_table($path) : String {
		$file = fopen($path, "r");
		
		$table = "<!-- Loaded by a php script made by naza :) !--><table>";
		
		while(($line = fgets($file)) !== false) {
			$columns = explode("=", $line);
			
			$table .= "<tr>";
			
			foreach ($columns as $column) {
				$table .= "<td>". trim($column) . "</td>";
			}
			
			$table .= "</tr>";
		}
		
		return $table . "</table>";
	}
	
	function markdown_to_html($path) : String {
		require("php/Parsedown.php");
		$file = fopen($path, "r");
		$parsedown = new Parsedown();
		return $parsedown->text(fread($file, filesize($path)));
	}
?>
