<?php
	session_start();
    include('controller/staffViewOrdersController.php');
    include('controller/staffUpdateOrderStatusController.php');
    include('controller/staffSearchOrdersController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "staff") {
        header("Location: loginUI.php");
    }

    $unfulfilledOrders = array();
    $fulfilledOrders = array();
    $searchOrders = array();
    
    $viewOrdersController = new staffViewOrdersController();
    $updateOrdersController = new staffUpdateOrderStatusController();
    $searchController = new staffSearchOrdersController();

    if (isset($_POST['viewUnfulfilled'])) {
        $_SESSION['currentView'] = "unfulfilled";
        $unfulfilledOrders = $viewOrdersController->viewUnfulfilledOrders();
    }

    if (isset($_POST['viewFulfilled'])) {
        $_SESSION['currentView'] = "fulfilled";
        $fulfilledOrders = $viewOrdersController->viewFulfilledOrders();
    }

    if (isset($_POST['searchOrders'])) {
        $_SESSION['currentView'] = "search";
        $searchView = "active";        
    }

    if (isset($_POST['searchOrder'])) {
		$orderNo = ($_POST['searchOrderNo']);
        $_SESSION['searchOrderNo'] = $orderNo;

		$searchOrders = $searchController->searchOrder($orderNo);
        if (empty($searchOrders)) {
            $_SESSION['searchEmptyError'] = "Nothing found.";
        }
	}

    if (isset($_SESSION['currentView'])) {
        if ($_SESSION['currentView'] == "unfulfilled"){
            $unfulfilledOrders = $viewOrdersController->viewUnfulfilledOrders();
        } else if ($_SESSION['currentView'] == "fulfilled") {
            $fulfilledOrders = $viewOrdersController->viewFulfilledOrders();
        } else if ($_SESSION['currentView'] == "search") {
            if (isset($_SESSION['searchOrderNo'])) {
                $searchOrders = $searchController->searchOrder($_SESSION['searchOrderNo']);
                if (empty($searchOrders)) {
                    $_SESSION['searchEmptyError'] = "Nothing found.";
                }
            }
        }
    }

    if (isset($_POST['setFulfilled'])) {
        $orderNo = ($_POST['orderNo']);

		$updateOrderResult = $updateOrdersController->orderFulfilled($orderNo);

        if ($updateOrderResult) {
            header("Location: staffUpdateOrdersUI.php");
        }
	} 
    
    if (isset($_POST['setUnfulfilled'])) {
        $orderNo = ($_POST['orderNo']);

		$updateOrderResult = $updateOrdersController->orderUnfulfilled($orderNo);

        if ($updateOrderResult) {
            header("Location: staffUpdateOrdersUI.php");
        }
    }
    
?>

<html>
    <head>
        <title>Update Order Status</title>
        <link rel="stylesheet" href="admin.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
    </head>
    <body>
    <div class="header">
        <table>
            <tr>
                <th><a href="staffHomeUI.php">Home</a></th>
                <th><a href="staffViewOrdersUI.php">View Orders</a></th>
                <th><a href="staffSearchOrdersUI.php">Search for Order</a></th>
                <th><a href="staffUpdateOrdersUI.php">Update Order Status</a></th>
                <th><a href="staffCancelOrdersUI.php">Cancel Orders</a></th>
            </tr>
        </table>
</div>
<div class="pageContent">

<form method="POST">
    <table>
        <tr>
            <td><input type="submit" name="viewUnfulfilled" value="View Unfulfilled Orders"></td>
            <td><input type="submit" name="viewFulfilled" value="View Fulfilled Orders"></td>
            <td><input type="submit" name="searchOrders" value="Search for Order"></td>
        </tr>
    </table>
</form>

<?php 
if (isset($searchView)) {
    echo "<table>
    <tr>
    <form method='POST'>
        <td>Search for Order:</td>
        <td><input type='text' name='searchOrderNo' placeholder='Order Number'></td>
        <td><button type='submit' name='searchOrder'>Search</button></td>
    </form>
    </tr>
    <tr>
        <td><span class='error'>";
        echo $_SESSION['searchEmptyError'];
        echo "</td>
    </tr>
    </table>";
}
?>

<?php

if (!empty($unfulfilledOrders)){
    echo "Viewing unfulfilled orders <br>";
    echo "<table border=1px solid black>";

    echo "<tr>
    <th>Order Number</th>
    <th>Table</th>
    <th>Name</th>
    <th>Order Details</th>
    <th>Order Cost</th>
    <th>Status</th>
    </tr>";
    foreach($unfulfilledOrders as $order) {
        echo "<tr>
        <td>".$order['orderNo']."</td>
        <td>".$order['tableCode']."</td>
        <td>".$order['name']."</td>
        <td>".$order['orderDetails']."</td>
        <td>".$order['cost']."</td>
        <td>".$order['status']."</td>
        <td>
            <form method='POST'>
                <input type='hidden' name='orderNo' value='".$order['orderNo']."'/>
                <input type='submit' name='setFulfilled' value='Order Delivered'>
            </form>
        </td>         
        </tr>";
    }
    echo "</table>";
}

if (!empty($fulfilledOrders)){
    echo "Viewing fulfilled orders <br>";
    echo "<table border=1px solid black>";

    echo "<tr>
    <th>Order Number</th>
    <th>Table</th>
    <th>Name</th>
    <th>Order Details</th>
    <th>Order Cost</th>
    <th>Status</th>
    </tr>";
    foreach($fulfilledOrders as $order) {
        echo "<tr>
        <td>".$order['orderNo']."</td>
        <td>".$order['tableCode']."</td>
        <td>".$order['name']."</td>
        <td>".$order['orderDetails']."</td>
        <td>".$order['cost']."</td>
        <td>".$order['status']."</td>
        <td>
            <form method='POST'>
                <input type='hidden' name='orderNo' value='".$order['orderNo']."'/>
                <input type='submit' name='setUnfulfilled' value='Order Preparing'>
            </form>
        </td>         
        </tr>";
    }
    echo "</table>";
}

if (!empty($searchOrders)){
    echo "Viewing unfulfilled orders <br>";
    echo "<table border=1px solid black>";

    echo "<tr>
    <th>Order Number</th>
    <th>Table</th>
    <th>Name</th>
    <th>Order Details</th>
    <th>Order Cost</th>
    <th>Status</th>
    </tr>";
    foreach($searchOrders as $order) {
        echo "<tr>
        <td>".$order['orderNo']."</td>
        <td>".$order['tableCode']."</td>
        <td>".$order['name']."</td>
        <td>".$order['orderDetails']."</td>
        <td>".$order['cost']."</td>
        <td>".$order['status']."</td>
        <td>
            <form method='POST'>
                <input type='hidden' name='orderNo' value='".$order['orderNo']."'/>";
                if (strcmp($order['status'], "preparing") == 0) {
                    echo "<input type='submit' name='setFulfilled' value='Order Delivered'>";
                } else {
                    echo "<input type='submit' name='setUnfulfilled' value='Order Preparing'>";
                }
                echo " </form>
        </td>         
        </tr>";
    }
    echo "</table>";
}
?>


</div>
</body>
</html>