<?php
	session_start();
    include('controller/customerPaymentController.php');

    $_SESSION['namePaymentError'] = "";
    $_SESSION['cardPaymentError'] = "";
    $_SESSION['yearPaymentError'] = "";
    $_SESSION['cvcPaymentError'] = "";
    $_SESSION['paymentError'] = "";

    if (isset($_POST['makePayment'])) {
        $name = ($_POST['name']);
		$ccNo = ($_POST['ccNo']);
        $year = ($_POST['year']);
        $cvc = ($_POST['cvc']);

        $paymentController = new customerPaymentController();
		$paymentResult = $paymentController->validatePayment($name, $ccNo, $year, $cvc);

        if ($paymentResult) {
            header("Location: customerViewOrderConfirmation.php");
        } else {
            $_SESSION['paymentError'] = "Payment Failed";
        }
	}
    
?>

<html>
    <head>
        <title>Make a Payment</title>
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

    <p>Your Order Costs $<?php echo $_SESSION['updatedCost'];?>.</p>

    <form method="POST">
    <table>
        <tr>
            <td>Name:</td>
            <td><input type="text" name="name" placeholder="Name"></td>
            <td><span class="error"><?php echo $_SESSION['namePaymentError']; ?></span></td>
        </tr>
        <tr>
            <td>Credit Card Number:</td>
            <td><input type="number" name="ccNo" placeholder="Credit Card Number"></td>
            <td><span class="error"><?php echo $_SESSION['cardPaymentError']; ?></span></td>
        </tr>
        <tr>
            <td>Card Expiry Year:</td>
            <td><input type="number" name="year" placeholder="Year"></td>
            <td><span class="error"><?php echo $_SESSION['yearPaymentError']; ?></span></td>
        </tr>
        <tr>
            <td>CVC:</td>
            <td><input type="number" name="cvc" placeholder="CVC"></td>
            <td><span class="error"><?php echo $_SESSION['cvcPaymentError']; ?></span></td>
        </tr>
        <tr>
            <td><button type="submit" name="makePayment">Pay</button></td>
            <td><span class="error"><?php echo $_SESSION['paymentError']; ?></span></td>
        </tr>
    </table>
    </form>



    </div>
    </body>
</html>