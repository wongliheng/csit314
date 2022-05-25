<?php
	session_start();
    include('controller/staffViewOrdersController.php');
    include('controller/staffCancelOrderController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "staff") {
        header("Location: loginUI.php");
    }
    
    $viewOrdersController = new staffViewOrdersController();
    $unfulfilledOrders = array();
    $unfulfilledOrders = $viewOrdersController->viewUnfulfilledOrders();

    if (isset($_POST['cancelOrder'])) {
		$orderNo = ($_POST['orderNo']);

		$cancelOrderController = new staffCancelOrderController();
		$cancelOrderResult = $cancelOrderController->cancelOrder($orderNo);
        
        if ($cancelOrderResult) {
            header("Location: staffCancelOrdersUI.php");
        }
	}
    
    
?>

<html>
    <head>
        <title>Cancel Orders</title>
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
<p>Cancel unfulfilled orders</p>

<?php
if (!empty($unfulfilledOrders)){
    echo "<table border=1px solid black>";

    echo "<tr>
    <th>Order Number</th>
    <th>Table</th>
    <th>Name</th>
    <th>Order Details</th>
    <th>Order Cost</th>
    <th>Status</th>
    <th>Cancel</th>
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
                <input type='submit' name='cancelOrder' value='Cancel'>
            </form>
        </td>   
        </tr>";
    }
    echo "</table>";
} else {
    echo "No unfulfilled orders.";
}
?>


</div>
</body>
</html>