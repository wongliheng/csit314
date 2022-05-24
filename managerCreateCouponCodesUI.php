<?php
	session_start();
    include('controller/managerCreateCouponCodeController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "manager") {
        header("Location: loginUI.php");
    }

    $_SESSION['codeError'] = "";
	$_SESSION['discountError'] = "";
    $_SESSION['notification'] = "";

    if (isset($_POST['addCode'])) {
        $code = ($_POST['code']);
		$discount = ($_POST['discount']);

        $createCodeController = new managerCreateCouponCodeController();
		$createCodeController->createCode($code, $discount);
	}
    
?>

<html>
    <head>
        <title>Add Coupon Code</title>
        <link rel="stylesheet" href="admin.css">
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

<p>Add a new coupon code</p>

    <form method="POST">
    <table>
        <tr>
            <td>Code:</td>
            <td><input type="text" name="code" placeholder="Code"></td>
            <td><span class="error"><?php echo $_SESSION['codeError'];?></span></td>
        </tr>
        <tr>
            <td>Discount (%):</td>
            <td><input type="number" name="discount" placeholder="Discount (%)"></td>
            <td><span class="error"><?php echo $_SESSION['discountError'];?></span></td>
        </tr>
        <tr>
            <td><button type="submit" name="addCode">Add Code</button></td>
        </tr>
    </table>
    </form>

    <span><?php echo $_SESSION['notification'];?></span>

</div>
</body>
</html>

<?php 
unset($_SESSION['codeError']);
unset($_SESSION['discountError']);
unset($_SESSION['notification']);
?>