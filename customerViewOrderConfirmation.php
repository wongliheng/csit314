<?php
	session_start();
    include('controller/customerViewOrderConfirmationController.php');
    
    $_SESSION['cart'] = array();
    $_SESSION['totalCost'] = 0;

    $customerViewOrderConfirmationController = new customerViewOrderConfirmationController();
    $orderConfirmation = $customerViewOrderConfirmationController->generateOrderConfirmation();
?>

<html>
    <head>
        <title>Order Confirmation</title>
        <link rel="stylesheet" href="menu.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
    </head>
    <body>
    <div class="header">
        <table>
            <tr>
                <th><a href="customerHomeUI.php">Home</a></th>
                <th>
                    <?php
                    echo "<a href='customerViewOrderUI.php'> Order (";
                    $count = count($_SESSION['cart']);
                    echo "".$count.")</a>";
                    ?>
                </th>
                <th><a href="loginUI.php">Staff Login</a></th>
            </tr>
        </table>
    </div>

    <div class="pageContent">

    <p>Payment Successful</p>
    <p>Details of your order</p>

    <?php 
    echo "<table border=1px solid black>";
    foreach ($orderConfirmation as $order) {
        $orderJsonObj = $order['orderDetails'];
        $orderDetails = json_decode($orderJsonObj);

        echo "<tr>
        <th>Order Date and Time</th>
        <td>".$order['endTime']."</td>
        </tr>
             
        <tr>
        <th>Table Code</th>
        <td>".$order['tableCode']."</td>
        </tr>

        <tr>
        <th>Order Cost</th>
        <td>".$order['cost']."</td>
        </tr>
        
        <th colspan='2'>Order Details</th>";
        
        foreach ($orderDetails as $item => $value) {
            echo "<tr>
            <td>".$item."</td>
            <td>".$value."</td>
            </tr>";
        }   

    }
    ?>



    </div>
    </body>
</html>