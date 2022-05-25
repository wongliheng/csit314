<?php
	session_start();
    include('controller/staffViewOrdersController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "staff") {
        header("Location: loginUI.php");
    }

    $allOrders = array();
    $unfulfilledOrders = array();
    $fulfilledOrders = array();
    
    $viewOrdersController = new staffViewOrdersController();
    
    if (isset($_POST['viewAll'])) {
		$allOrders = $viewOrdersController->viewAllOrders();
	}

    if (isset($_POST['viewUnfulfilled'])) {
        $unfulfilledOrders = $viewOrdersController->viewUnfulfilledOrders();
    }

    if (isset($_POST['viewFulfilled'])) {
        $fulfilledOrders = $viewOrdersController->viewFulfilledOrders();
    }
    
?>

<html>
    <head>
        <title>View Orders</title>
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
            <td><input type="submit" name="viewAll" value="View All Orders"></td>
            <td><input type="submit" name="viewUnfulfilled" value="View Unfulfilled Orders"></td>
            <td><input type="submit" name="viewFulfilled" value="View Fulfilled Orders"></td>
        </tr>
    </table>
</form>

<?php
if (!empty($allOrders)){
    echo "Viewing all orders <br>";
    echo "<table border=1px solid black>";

    echo "<tr>
    <th>Order Number</th>
    <th>Table</th>
    <th>Name</th>
    <th>Order Details</th>
    <th>Order Cost</th>
    <th>Status</th>
    </tr>";
    foreach($allOrders as $order) {
        echo "<tr>
        <td>".$order['orderNo']."</td>
        <td>".$order['tableCode']."</td>
        <td>".$order['name']."</td>
        <td>".$order['orderDetails']."</td>
        <td>".$order['cost']."</td>
        <td>".$order['status']."</td>        
        </tr>";
    }
    echo "</table>";
}

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
        </tr>";
    }
    echo "</table>";
}
?>


</div>
</body>
</html>