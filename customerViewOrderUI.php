<?php
	session_start();
    include('controller/customerViewOrdersController.php');
    include('controller/customerApplyCouponController.php');
    include('controller/customerDeleteOrderController.php');
    
    $_SESSION['codeNotification'] = "";

    if (isset($_POST['makePayment'])) {

        if ($_SESSION['couponActive'] == 1){
            $_SESSION['updatedCost'] = $_SESSION['totalCost'] * (100 - $_SESSION['discount']) / 100;
        } else {
            $_SESSION['updatedCost'] = $_SESSION['totalCost'];
        }

        header("Location: customerPaymentUI.php");
    }

    if (isset($_POST['applyCoupon'])) {
        $code = $_POST['couponCode'];

        $customerApplyCouponController = new customerApplyCouponController();
        $couponResult = $customerApplyCouponController->applyCouponCode($code);

        if ($couponResult) {
            $_SESSION['updatedCost'] = $_SESSION['totalCost'] * (100 - $_SESSION['discount']) / 100;
        } else {
            $_SESSION ['updatedCost'] = $_SESSION['totalCost'];
        }
    }

    if (isset($_POST['deleteOrder'])) {
        $customerDeleteOrderController = new customerDeleteOrderController();
        $customerDeleteOrderController->deleteOrder();
        header("Location: customerViewOrderUI.php");
    }

    $customerViewOrderController = new customerViewOrdersController();
    $currentOrder = $customerViewOrderController->requestViewOrders();
?>

<html>
    <head>
        <title>Your Order</title>
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
                    // echo "<a href='customerViewOrderUI.php'> Order (";
                    // if (count($_SESSION['cart']) > 0) {
                    //     $count = count($_SESSION['cart']) - 1;
                    //     echo "".$count.")</a>";
                    // } else {
                    //     echo "0)</a>";
                    // }
                    ?>
                </th>
                <th><a href="loginUI.php">Staff Login</a></th>
            </tr>
        </table>
    </div>

    <div class="pageContent">

    <p>Your Order Details</p>

    <?php
    if (empty($_SESSION['cart'])) {
        echo "<p>You have not ordered anything yet.</p>";

    } else {

	echo "<table border=1px solid black>";
	echo "<tr>
					<th>
						Name
					</th>
                    <th>
						Quantity
					</th>
				</tr>";

            foreach($currentOrder as $item => $value) {
                echo "<tr>";
                echo "<td>".$item."</td>";
                echo "<td>".$value."</td>";
                echo "</tr>";
            }

            echo "<tr>
            <td>Total Cost</td><td>$" ;
                echo $_SESSION['totalCost'];
            echo "</td>
            </tr>";
				
			echo "</table>";

            echo "<form method='POST'>
            <table>
            <tr>
            <td>Coupon Code:</td>
            <td><input type='text' name='couponCode' placeholder='Code'></td>
            <td><span class='error'>";
            echo $_SESSION['codeNotification'];
            echo"</span></td>
            </tr>
            <tr>
                <td><button type='submit' name='applyCoupon'>Apply Coupon Code</button></td>
            </tr>
            </table>
            </form>";

            echo "<form method='POST'>
            <table>
                <tr>
                    <td><button type='submit' name='deleteOrder'>Delete Order</button></td>
                </tr>
            </table>
            </form>";

            echo "<form method='POST'>
            <table>
                <tr>
                    <td><button type='submit' name='makePayment'>Make Payment</button></td>
                </tr>
            </table>
            </form>";
            
    }

    ?>

   



    </div>
    </body>
</html>