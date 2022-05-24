<?php
	session_start();
    include('controller/managerAddMenuItemController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "manager") {
        header("Location: loginUI.php");
    }

    $_SESSION['nameError'] = "";
	$_SESSION['priceError'] = "";
    $_SESSION['descriptionError'] = "";
    $_SESSION['imageError'] = "";
    $_SESSION['notification'] = "";

    if (isset($_POST['addItem'])) {
        $name = ($_POST['itemName']);
		$price = ($_POST['itemPrice']);
        $description = ($_POST['itemDescription']);
		$image = ($_POST['itemImage']);

        $addMenuItemController = new managerAddMenuItemController();
		$addMenuItemController->addItem($name, $price, $description, $image);
	}
    
?>

<html>
    <head>
        <title>Add Menu Item</title>
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

<p>Add a new menu item</p>

    <form method="POST">
    <table>
        <tr>
            <td>Name:</td>
            <td><input type="text" name="itemName" placeholder="Item Name"></td>
            <td><span class="error"><?php echo $_SESSION['nameError'];?></span></td>
        </tr>
        <tr>
            <td>Price:</td>
            <td><input type="text" name="itemPrice" placeholder="Item Price"></td>
            <td><span class="error"><?php echo $_SESSION['priceError'];?></span></td>
        </tr>
        <tr>
            <td>Description:</td>
            <td><input type="text" name="itemDescription" placeholder="Item Description"></td>
            <td><span class="error"><?php echo $_SESSION['descriptionError'];?></span></td>
        </tr>
        <tr>
            <td>Image:</td>
            <td><input type="file" name="itemImage"></td>
            <td><span class="error"><?php echo $_SESSION['imageError'];?></span></td>
        </tr>
        <tr>
            <td><button type="submit" name="addItem">Add Item</button></td>
        </tr>
    </table>
    </form>

    <span><?php echo $_SESSION['notification'];?></span>

</div>
</body>
</html>

<?php 
unset($_SESSION['nameError']);
unset($_SESSION['priceError']);
unset($_SESSION['descriptionError']);
unset($_SESSION['notification']);
?>