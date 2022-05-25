<?php

class Report {
    function __construct() {
		include('db_connection.php');
		$this->conn = $conn;
	}

    public function viewDailySpendReport($month) {
        $report = array();
		$sql = "SELECT count(*), day, month, ROUND(AVG(cost),2) FROM `orderdetails` WHERE month ='".$month."' GROUP BY day ORDER BY day ASC;";
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$report[] = $row;
			}
		}
		return $report;
    }

    public function viewWeeklySpendReport($month) {
        $report = array();
		$sql = "SELECT count(*), week, ROUND(AVG(cost),2), SUM(cost) FROM `orderdetails` WHERE month ='".$month."' GROUP BY week ORDER BY week ASC;";
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$report[] = $row;
			}
		}
		return $report;
    }

	public function viewMonthlySpendReport() {
        $report = array();
		$sql = "SELECT count(*), month, ROUND(AVG(cost),2), SUM(cost) FROM `orderdetails` GROUP BY month ORDER BY month DESC;";
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$report[] = $row;
			}
		}
		return $report;
    }

	public function viewDailyOrderReport($day, $month) {
        $report = array();
		$sql = "SELECT * FROM `orderDetails` WHERE day ='".$day."' AND month = '".$month."'";
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$report[] = $row;
			}
		}
		return $report;
    }

    public function viewWeeklyOrderReport($week, $month) {
        $report = array();
		$sql = "SELECT * FROM `orderDetails` WHERE week ='".$week."' AND month = '".$month."'";
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$report[] = $row;
			}
		}
		return $report;
    }

	public function viewMonthlyOrderReport($month) {
        $report = array();
		$sql = "SELECT * FROM `orderDetails` WHERE month = '".$month."'";
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$report[] = $row;
			}
		}
		return $report;
    }

	public function viewDailyVisitReport($day, $month) {
        $report = array();
		$sql = "SELECT count(*), hour FROM `orderDetails` WHERE day ='".$day."' AND month = '".$month."' GROUP BY hour";
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$report[] = $row;
			}
		}
		return $report;
    }

    public function viewWeeklyVisitReport($week, $month) {
        $report = array();
		$sql = "SELECT count(*), hour FROM `orderDetails` WHERE week ='".$week."' AND month = '".$month."' GROUP BY hour";
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$report[] = $row;
			}
		}
		return $report;
    }

	public function viewMonthlyVisitReport($month) {
        $report = array();
		$sql = "SELECT count(*), hour FROM `orderDetails` WHERE month = '".$month."' GROUP BY hour";
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$report[] = $row;
			}
		}
		return $report;
    }
}