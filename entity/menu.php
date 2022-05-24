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

	public function updateMenuItem($name, $price, $description) {
		$sql = "UPDATE `menu` SET `price`='".$price."', `description`='".$description."'
		WHERE `menu`.`name`='".$name."'";
		$result = @mysqli_query($this->conn, $sql);
		if (!$result) {
			return false;
		} else {
			return true;
		}
	}

	public function addItem($name, $price, $description, $image) {
		$sql = "SELECT * FROM `menu` WHERE `name` ='".$name."'";
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			$_SESSION['notification'] = "Item already exists in the menu."; 
			return false;
		} else {
			$status = "available";
			$sql2 = "INSERT INTO `menu` (`name`, `price`, `description`, `image`, `status`) VALUES 
			('".$name."', '".$price."', '".$description."', '".$image."', '".$status."')";
			$result2 = @mysqli_query($this->conn, $sql2);
			if (!$result2) {
				$_SESSION['notification'] = "Unable to add menu item."; 
				return false;
			} else {
				$_SESSION['notification'] = "Menu item successfully added";
				return true;
			}
		}
	}

	public function deleteItem($name) {
		$sql = "DELETE FROM menu WHERE name ='".$name."'";
        $result = @mysqli_query($this->conn, $sql);
        if (!$result) {
            return false;
        } else {
            return true;
        }
	}

	public function flagItem($name, $status) {
		$sql = "UPDATE `menu` SET `status`='".$status."'WHERE `menu`.`name`='".$name."'";
		$result = @mysqli_query($this->conn, $sql);
		if (!$result) {
			return false;
		} else {
			return true;
		}
	}
}