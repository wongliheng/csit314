<?php
	session_start();
    include('controller/managerUpdateCouponCodeController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "manager") {
        header("Location: loginUI.php");
    }

    $_SESSION['updateCodeError'] = "";
	$_SESSION['updateDiscountError'] = "";
    $_SESSION['notification'] = "";

    if (empty($_POST['updateCouponCode'])) {
        $_SESSION['codePkey'] = $_POST['pkey'];
        $_SESSION['updateCode'] = $_POST['code'];
        $_SESSION['updateDiscount'] = $_POST['discount'];
    } else {
        $_SESSION['updateCode'] = $_POST['updatedCode'];
        $_SESSION['updateDiscount'] = $_POST['updatedDiscount'];
    }

    if (isset($_POST['updateCouponCode'])) {
        $code = ($_POST['updatedCode']);
        $discount = ($_POST['updatedDiscount']);

        $updateCodeController = new managerUpdateCouponCodeController();
		$updateCodeResult = $updateCodeController->updateCode($_SESSION['codePkey'], $code, $discount);

        if ($updateCodeResult) {
            $_SESSION['notification'] = "Coupon code successfully updated";
        } else {
            $_SESSION['notification'] = "Unable to update coupon code.";
        }
	}
    
?>

<html>
    <head>
        <title>Update Coupon Code</title>
        <link rel="stylesheet" href="menu.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
    </head>
    <body>
    <div class="header">
        <table>
            <tr>
                <th><a href="managerHomeUI.php">Home</a></th>
                <th><a href="managerViewMenuUI.php">View Menu</a></th>
                <th><a href="managerAddMenuItemUI.php">Add Menu Item</a></th>
                <th><a href="managerManageCouponCodesUI.php">Manage Coupon Codes</a></th>
            </tr>
        </table>
</div>
<div class="pageContent">
<p>Updating Coupon Code (<?php echo $_SESSION['updateCode']; ?>)</p>
        
    <form method="POST">
		<label for="name"> Code:</label>
		<input type="text" name="updatedCode" value="<?php echo $_SESSION['updateCode']; ?>" />
		<span class="error"><?php echo $_SESSION['updateCodeError']; ?></span>
		<br>
        <label for="email"> Discount (%):</label>
		<input type="number" name="updatedDiscount" value="<?php echo $_SESSION['updateDiscount']; ?>" />
		<span class="error"><?php echo $_SESSION['updateDiscountError']; ?></span>
        <br>
		<input type="submit" name="updateCouponCode" value="Update" />
	</form>
	<span><?php echo $_SESSION['notification']; ?></span>


</div>
</body>
</html>

<?php
unset($_SESSION['updateCodeError']);
unset($_SESSION['updateDiscountError']);
?>