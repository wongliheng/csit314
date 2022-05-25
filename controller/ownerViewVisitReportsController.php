<?php

class ownerViewVisitReportsController {

    public function viewDailyReport($day, $month) {
        require_once("./entity/report.php");
		
		$reportClass = new Report();
		$report = $reportClass->viewDailyVisitReport($day, $month);

		return $report;
    }

    public function viewWeeklyReport($week, $month) {
        require_once("./entity/report.php");
		
		$reportClass = new Report();
		$report = $reportClass->viewWeeklyVisitReport($week, $month);

		return $report;
    }

    public function viewMonthlyReport($month) {
        require_once("./entity/report.php");
		
		$reportClass = new Report();
		$report = $reportClass->viewMonthlyVisitReport($month);

		return $report;
    }
}