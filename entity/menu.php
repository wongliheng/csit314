<?php

class Menu {
    function __construct() {
		include('db_connection.php');
		$this->conn = $conn;
	}

    public function viewMenu() {
		$menu = array();
		$sql = "SELECT * FROM menu";
		$result = @mysqli_query($this->conn, $sql);
		
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$menu[] = $row;
			}
		}
		return $menu;
	}

	public function searchMenu($input) {
		$search = array();
		$sql = "SELECT * FROM menu WHERE (`name` LIKE '%".$input."%');";
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$search[] = $row;
			}
		}
		return $search;
	}
}