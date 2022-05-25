<?php
	session_start();
    include('controller/staffSearchOrdersController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "staff") {
        header("Location: loginUI.php");
    }

    $_SESSION['searchEmptyError'] = "";

    if (isset($_POST['searchOrder'])) {
		$orderNo = ($_POST['searchOrderNo']);

        $searchController = new staffSearchOrdersController();
		$searchOrders = $searchController->searchOrder($orderNo);
        if (empty($searchOrders)) {
            $_SESSION['searchEmptyError'] = "Nothing found.";
        }
	}

    
?>

<html>
    <head>
        <title>Search for Orders</title>
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

<table>
    <tr>
    <form method="POST">
        <td>Search for Order:</td>
        <td><input type="text" name="searchOrderNo" placeholder="Order Number"></td>
        <td><button type="submit" name="searchOrder">Search</button></td>
    </form>
    </tr>
    <tr>
        <td><span class="error"><?php echo $_SESSION['searchEmptyError'];?></td>
    </tr>
</table>

<?php
if (!empty($searchOrders)){
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
        </tr>";
    }
    echo "</table>";
}
?>

</div>

</body>
</html>