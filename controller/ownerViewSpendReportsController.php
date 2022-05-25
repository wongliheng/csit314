<?php

class ownerViewSpendReportsController {

    public function viewDailyReport($month) {
        require_once("./entity/report.php");
		
		$reportClass = new Report();
		$report = $reportClass->viewDailySpendReport($month);

		return $report;
    }

    public function viewWeeklyReport($month) {
        require_once("./entity/report.php");
		
		$reportClass = new Report();
		$report = $reportClass->viewWeeklySpendReport($month);

		return $report;
    }

    public function viewMonthlyReport() {
        require_once("./entity/report.php");
		
		$reportClass = new Report();
		$report = $reportClass->viewMonthlySpendReport();

		return $report;
    }
}