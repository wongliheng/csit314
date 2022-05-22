<?php
	session_start();
    include('controller/managerUpdateMenuController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "manager") {
        header("Location: loginUI.php");
    }

    $_SESSION['updatePriceError'] = "";
	$_SESSION['updateDescriptionError'] = "";
    $_SESSION['notification'] = "";

    if (empty($_POST['updateItemName'])) {
        $_SESSION['itemName'] = $_POST['itemName'];
        $_SESSION['updatePrice'] = $_POST['itemPrice'];
        $_SESSION['updateDescription'] = $_POST['itemDescription'];
    } else {
        $_SESSION['updatePrice'] = $_POST['updatedPrice'];
        $_SESSION['updateDescription'] = $_POST['updatedDescription'];
    }

    if (isset($_POST['updateItemName'])) {
        $price = ($_POST['updatedPrice']);
        $description = ($_POST['updatedDescription']);

        $updateMenu = new managerUpdateMenuController();
		$updateMenuResult = $updateMenu->validateUpdateDetails($_SESSION['itemName'], $price, $description);

        if ($updateMenuResult) {
            $_SESSION['notification'] = "Menu item successfully updated";
        } else {
            $_SESSION['notification'] = "Unable to update menu item.";
        }
	}
    
?>

<html>
    <head>
        <title>Update Menu Item</title>
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
            </tr>
        </table>
</div>
<div class="pageContent">
<p>Updating Menu Item (<?php echo $_SESSION['itemName']; ?>)</p>
        
    <form method="POST">
		<label for="name"> Price:</label>
		<input type="text" id="name" name="updatedPrice" value="<?php echo $_SESSION['updatePrice']; ?>" />
		<span class="error"><?php echo $_SESSION['updatePriceError']; ?></span>
		<br>
        <label for="email"> Description:</label>
		<input type="text" id="email" name="updatedDescription" value="<?php echo $_SESSION['updateDescription']; ?>" />
		<span class="error"><?php echo $_SESSION['updateDescriptionError']; ?></span>
        <br>
        <input type='hidden' name='updateItemName' value="<?php echo $_SESSION['itemName']; ?>"/>
		<input type="submit" name="updateMenuItem" value="Update" />
	</form>
	<span><?php echo $_SESSION['notification']; ?></span>


</div>
</body>
</html>