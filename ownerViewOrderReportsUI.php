<?php
	session_start();
    include('controller/ownerViewOrderReportsController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "owner") {
        header("Location: loginUI.php");
    }

    $dailyReport = array();
    $weeklyReport = array();
    $monthlyReport = array();
    
    $orderReportsController = new ownerViewOrderReportsController();
    
    if (isset($_POST['viewDaily'])) {
		$frequency = "daily";
	}

    if (isset($_POST['viewWeekly'])) {
        $frequency = "weekly";
    }

    if (isset($_POST['viewMonthly'])) {
        $frequency = "monthly";
    }

    if (isset($_POST['submitDay'])) {
		$date = $_POST['date'];
        $dateArray = explode('-', $date);
        $month = (string)((int)($dateArray[1]));
        $day = (string)((int)($dateArray[2]));

        $dailyReport = $orderReportsController->viewDailyReport($day, $month);
	}

    if (isset($_POST['submitWeek'])) {
		$week = $_POST['week'];
        $month = $_POST['month'];

        $weeklyReport = $orderReportsController->viewWeeklyReport($week, $month);
	}

    if (isset($_POST['submitMonth'])) {
        $month = $_POST['month'];

        $monthlyReport = $orderReportsController->viewMonthlyReport($month);
	}
?>

<html>
    <head>
        <title>Order Preference Reports</title>
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
            echo "<form method='POST'>
            <input type='date' name='date'>
            <input type='submit' name='submitDay'>        
            </form>";
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
            <tr>
                <td>Select a week:</td>
                <td>
                    <select name='week'>
                    <option value='1'>Week 1</option>
                    <option value='2'>Week 2</option>
                    <option value='3'>Week 3</option>
                    <option value='4'>Week 4</option>
                    <option value='5'>Week 5</option>
                    </select>
                </td>
            </tr>
            <tr><td><input type='submit' name='submitWeek' value='View'></td></tr>
            </form></table>";
        }
        
        if ($frequency == "monthly") {
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
            <tr><td><input type='submit' name='submitMonth' value='View'></td></tr>
            </form></table>";
        }
    }
?>

<?php
if (!empty($dailyReport)){
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
    echo "Viewing Report for ".$day." ".$monthString." <br>";
    echo "<table border=1px solid black>";
    $orderArray = array();
    foreach($dailyReport as $report) {
        $jsonObject = $report['orderDetails'];
        $order = json_decode($jsonObject);
        foreach ($order as $key => $value) {
            if (!array_key_exists($key, $orderArray)) {
                $orderArray[$key] = $value;
            } else {
                $quantity = $orderArray[$key];
                $quantity = $quantity + $value;
                $orderArray[$key] = $quantity;
            }
        }
    }
    arsort($orderArray);

    echo "<tr>
    <th>Item</th>
    <th>Amount Ordered</th>
    </tr>";

    foreach($orderArray as $item => $quantity) {
        echo "<tr>";
        echo "<td>".$item."</td>";
        echo "<td>".$quantity."</td>";
        echo "</tr>";
    }
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
    echo "Viewing Report for Week ".$week." of ".$monthString." <br>";
    echo "<table border=1px solid black>";
    $orderArray = array();
    foreach($weeklyReport as $report) {
        $jsonObject = $report['orderDetails'];
        $order = json_decode($jsonObject);
        foreach ($order as $key => $value) {
            if (!array_key_exists($key, $orderArray)) {
                $orderArray[$key] = $value;
            } else {
                $quantity = $orderArray[$key];
                $quantity = $quantity + $value;
                $orderArray[$key] = $quantity;
            }
        }
    }
    arsort($orderArray);

    echo "<tr>
    <th>Item</th>
    <th>Amount Ordered</th>
    </tr>";

    foreach($orderArray as $item => $quantity) {
        echo "<tr>";
        echo "<td>".$item."</td>";
        echo "<td>".$quantity."</td>";
        echo "</tr>";
    }
}

if (!empty($monthlyReport)){
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
    echo "Viewing Report for ".$monthString." <br>";
    echo "<table border=1px solid black>";
    $orderArray = array();
    foreach($monthlyReport as $report) {
        $jsonObject = $report['orderDetails'];
        $order = json_decode($jsonObject);
        foreach ($order as $key => $value) {
            if (!array_key_exists($key, $orderArray)) {
                $orderArray[$key] = $value;
            } else {
                $quantity = $orderArray[$key];
                $quantity = $quantity + $value;
                $orderArray[$key] = $quantity;
            }
        }
    }
    arsort($orderArray);

    echo "<tr>
    <th>Item</th>
    <th>Amount Ordered</th>
    </tr>";

    foreach($orderArray as $item => $quantity) {
        echo "<tr>";
        echo "<td>".$item."</td>";
        echo "<td>".$quantity."</td>";
        echo "</tr>";
    }
}
?>


</div>
    </body>
</html>