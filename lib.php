<?php

class lib {
	static function db_query($query) {             
		global $mysqli;               
		$result = $mysqli->query($query) or trigger_error("Query Failed! SQL: $query - Error: ".mysqli_error($mysqli), E_USER_ERROR);
		return $result;
	}

	static function menu_from_assoc_array($name, &$array, $dummy_option='', $selected='', $multiple='', $event_handler='') {
		$id = str_replace(array('[',']'),'',$name); 
		$menu = "<select name=\"$name\" id=\"$id\" $multiple $event_handler >\n";
		if ($dummy_option) {
			$menu .= "<option value=\"\" ";
			if ($default == '' ) {
				$menu .= "selected='yes'";
			}
			$menu .= ">$dummy_option</option>\n";
		}
				            
		foreach ($array as $key=>$value) {
			$menu .= "<option value=\"$key\" ";
			if ( (!is_array($selected) && $key==$selected) || (is_array($selected) && in_array($key,$selected)) ) {
				$menu .= "selected='yes'";
			}
			$menu .= ">$value</option>\n";
		}
		$menu .= "</select>\n";
		return $menu;
	}
}
?>
