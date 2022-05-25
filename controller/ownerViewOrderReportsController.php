<?php

class ownerViewOrderReportsController {

    public function viewDailyReport($day, $month) {
        require_once("./entity/report.php");
		
		$reportClass = new Report();
		$report = $reportClass->viewDailyOrderReport($day, $month);

		return $report;
    }

    public function viewWeeklyReport($week, $month) {
        require_once("./entity/report.php");
		
		$reportClass = new Report();
		$report = $reportClass->viewWeeklyOrderReport($week, $month);

		return $report;
    }

    public function viewMonthlyReport($month) {
        require_once("./entity/report.php");
		
		$reportClass = new Report();
		$report = $reportClass->viewMonthlyOrderReport($month);

		return $report;
    }
}