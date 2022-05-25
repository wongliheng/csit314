<?php
	session_start();
    include('controller/ownerViewSpendReportsController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "owner") {
        header("Location: loginUI.php");
    }

    $dailyReport = array();
    $weeklyReport = array();
    $monthlyReport = array();
    
    $spendReportsController = new ownerViewSpendReportsController();

    if (isset($_POST['viewDaily'])) {
		$frequency = "daily";
	}

    if (isset($_POST['viewWeekly'])) {
        $frequency = "weekly";
    }

    if (isset($_POST['viewMonthly'])) {
        $monthlyReport = $spendReportsController->viewMonthlyReport();
    }
    
    if (isset($_POST['submitDay'])) {
		$month = $_POST['month'];

        $dailyReport = $spendReportsController->viewDailyReport($month);
	}

    if (isset($_POST['submitWeek'])) {
        $month = $_POST['month'];

        $weeklyReport = $spendReportsController->viewWeeklyReport($month);
	}
?>

<html>
    <head>
        <title>Average Spend Reports</title>
        <link rel="stylesheet" href="admin.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
    </head>
    <body>
    <div class="header">
        <table>
            <tr>
                <th><a href="ownerHomeUI.php">Home</a></th>
                <th><a href="ownerViewSpendReportsUI.php">View Spend Reports</a></th>
                <th><a href="ownerViewOrderReportsUI.php">View Order Preference Reports</a></th>
                <th><a href="ownerViewVisitReportUI.php">View Visit Reports</a></th>
            </tr>
        </table>
</div>
<div class="pageContent">

<form method="POST">
    <table>
        <tr>
            <td><input type="submit" name="viewDaily" value="View Daily Report"></td>
            <td><input type="submit" name="viewWeekly" value="View Weekly Report"></td>
            <td><input type="submit" name="viewMonthly" value="View Monthly Report"></td>
        </tr>
    </table>
</form>
<?php
    if (isset($frequency)) {
        if ($frequency == "daily") {
            echo "<table><form method='POST'>
            <tr>
                <td>Select a month:</td>
                <td>
                    <select name='month'>
                    <option value='1'>January</option>
                    <option value='2'>February</option>
                    <option value='3'>March</option>
                    <option value='4'>April</option>
                    <option value='5'>May</option>
                    <option value='6'>June</option>
                    <option value='7'>July</option>
                    <option value='8'>August</option>
                    <option value='9'>September</option>
                    <option value='10'>October</option>
                    <option value='11'>November</option>
                    <option value='12'>December</option>
                    </select>
                </td>
            </tr>
            <tr><td><input type='submit' name='submitDay' value='View'></td></tr>
            </form></table>";
        }

        if ($frequency == "weekly") {
            echo "<table><form method='POST'>
            <tr>
                <td>Select a month:</td>
                <td>
                    <select name='month'>
                    <option value='1'>January</option>
                    <option value='2'>February</option>
                    <option value='3'>March</option>
                    <option value='4'>April</option>
                    <option value='5'>May</option>
                    <option value='6'>June</option>
                    <option value='7'>July</option>
                    <option value='8'>August</option>
                    <option value='9'>September</option>
                    <option value='10'>October</option>
                    <option value='11'>November</option>
                    <option value='12'>December</option>
                    </select>
                </td>
            </tr>
            <tr><td><input type='submit' name='submitWeek' value='View'></td></tr>
            </form></table>";
        }
    }
?>

<?php

if (!empty($dailyReport)){
echo "Daily Report <br>";
echo "<table border=1px solid black>";
echo "<tr>
                <th>
                    Date
                </th>
                <th>
                    Average Spend
                </th>
                <th>
                    Total Orders
                </th>
            </tr>";
        foreach ($dailyReport as $report) {
            $monthNo = $report['month'];
            $month = "December";
            if ($monthNo == 1) {
                $month = "January";
            } else if ($monthNo == 2) {
                $month = "February";
            } else if ($monthNo == 3) {
                $month = "March";
            } else if ($monthNo == 4) {
                $month = "April";
            } else if ($monthNo == 5) {
                $month = "May";
            } else if ($monthNo == 6) {
                $month = "June";
            } else if ($monthNo == 7) {
                $month = "July";
            } else if ($monthNo == 8) {
                $month = "August";
            } else if ($monthNo == 9) {
                $month = "September";
            } else if ($monthNo == 10) {
                $month = "October";
            } else if ($monthNo == 11) {
                $month = "November";
            }

            echo "<tr>
            <td>".$report['day']." ".$month." </td>
            <td>$".$report['ROUND(AVG(cost),2)']."</td>
            <td>".$report['count(*)']."</td>
            </tr>";
        }
        echo "</table>";
}

if (!empty($weeklyReport)){
$monthString = "December";
if ($month == 1) {
    $monthString = "January";
} else if ($month == 2) {
    $monthString = "February";
} else if ($month == 3) {
    $monthString = "March";
} else if ($month == 4) {
    $monthString = "April";
} else if ($month == 5) {
    $monthString = "May";
} else if ($month == 6) {
    $monthString = "June";
} else if ($month == 7) {
    $monthString = "July";
} else if ($month == 8) {
    $monthString = "August";
} else if ($month == 9) {
    $monthString = "September";
} else if ($month == 10) {
    $monthString = "October";
} else if ($month == 11) {
    $monthString = "November";
}
echo "Viewing Weekly Report for ".$monthString." <br>";
echo "<table border=1px solid black>";
echo "<tr>
                <th>
                    Week
                </th>
                <th>
                    Average Spend
                </th>
                <th>
                    Total Spend
                </th>
                <th>
                    Total Orders
                </th>
            </tr>";
        foreach ($weeklyReport as $report) {
            echo "<tr>
            <td>".$report['week']."</td>
            <td>$".$report['ROUND(AVG(cost),2)']."</td>
            <td>$".$report['SUM(cost)']."</td>
            <td>".$report['count(*)']."</td>
            </tr>";
        }
        echo "</table>";
}

if (!empty($monthlyReport)){
echo "Monthly Report <br>";
echo "<table border=1px solid black>";
echo "<tr>
                <th>
                    Month
                </th>
                <th>
                    Average Spend
                </th>
                <th>
                    Total Spend
                </th>
                <th>
                    Total Orders
                </th>
            </tr>";
        foreach ($monthlyReport as $report) {
            $monthNo = $report['month'];
            $month = "December";
            if ($monthNo == 1) {
                $month = "January";
            } else if ($monthNo == 2) {
                $month = "February";
            } else if ($monthNo == 3) {
                $month = "March";
            } else if ($monthNo == 4) {
                $month = "April";
            } else if ($monthNo == 5) {
                $month = "May";
            } else if ($monthNo == 6) {
                $month = "June";
            } else if ($monthNo == 7) {
                $month = "July";
            } else if ($monthNo == 8) {
                $month = "August";
            } else if ($monthNo == 9) {
                $month = "September";
            } else if ($monthNo == 10) {
                $month = "October";
            } else if ($monthNo == 11) {
                $month = "November";
            }

            echo "<tr>
            <td>".$month."</td>
            <td>$".$report['ROUND(AVG(cost),2)']."</td>
            <td>$".$report['SUM(cost)']."</td>
            <td>".$report['count(*)']."</td>
            </tr>";
        }
        echo "</table>";
}
?>


</div>
    </body>
</html>