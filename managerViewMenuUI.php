<?php
	session_start();
    include('controller/managerViewMenuController.php');
    include('controller/managerFlagMenuItemController.php');
    include('controller/managerDeleteMenuItemController.php');
    include('controller/managerSearchMenuItemController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "manager") {
        header("Location: loginUI.php");
    }

    $viewMenu = new managerViewMenuController();
    $menuItem = $viewMenu->requestViewMenu();

    $_SESSION['searchEmptyError'] = "";

    if (isset($_POST['deleteMenuItem'])) {
		$name = ($_POST['deleteItemName']);

		$deleteMenuItemController = new managerDeleteMenuItemController();
		$deleteItemResult = $deleteMenuItemController->deleteItem($name);
        
        if ($deleteItemResult) {
            header("Location: managerViewMenuUI.php");
        }
	}

    if (isset($_POST['flagSoldOut'])) {
        $name = ($_POST['flagItemName']);
        $status = "Sold Out";

        $flagController = new managerFlagMenuItemController();
		$flagResult = $flagController->flagItem($name, $status);

        if ($flagResult) {
            header("Location: managerViewMenuUI.php");
        }
	} else if (isset($_POST['flagInStock'])) {
        $name = ($_POST['flagItemName']);
        $status = "In Stock";

        $flagController = new managerFlagMenuItemController();
		$flagResult = $flagController->flagItem($name, $status);

        if ($flagResult) {
            header("Location: managerViewMenuUI.php");
        }
    }

    if (isset($_POST['searchMenu'])) {
		$item = ($_POST['searchMenuItem']);

        $searchMenu = new managerSearchMenuItemController();
		$menuItem = $searchMenu->search($item);
        if (empty($menuItem)) {
            $_SESSION['searchEmptyError'] = "Nothing found.";
        }
	} else {
        $viewMenu = new managerViewMenuController();
        $menuItem = $viewMenu->requestViewMenu();
    }

    if (isset($_POST['reset'])) {
        header("Location: managerViewMenuUI.php");
    }
    
?>

<html>
    <head>
        <title>View Menu</title>
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
<br>
<div class="pageContent">
<table>
        <tr>
        <form method="POST">
            <td><input type="text" name="searchMenuItem" placeholder="Search Menu"></td>
            <td><button type="submit" name="searchMenu">Search</button></td>
        </form>
        </tr>
        <tr>
            <td><span class="error"><?php echo $_SESSION['searchEmptyError'];?></td>
        </tr>
        <tr>
            <td>
            <form method="POST">
                <button type="submit" name="reset">View Whole Menu</button>
            </form>
            </td>
        </tr>
</table>

<?php

if (!empty($menuItem)){
echo "<table class=menuTable>";
echo "<tr>
                <th>
                    Name
                </th>
                <th>
                    Price
                </th>
                <th>
                    Description
                </th>
                <th>
                    Status
                </th>
                <th>
                    Image
                </th>
            </tr>";
        foreach ($menuItem as $item) {
            echo "<tr>
                    <td>".$item['name']."</td>
                    <td>$".$item['price']."</td>
                    <td>".$item['description']."</td>
                    <td>".$item['status']."</td>";
                    $imagelink = $item['image'];
                    echo "<td><img src='images/".$imagelink."'>";
                    echo "</td>
                    <td>
                        <form action='managerUpdateMenuUI.php' method='POST'>
								<input type='hidden' name='itemName' value='".$item['name']."'/>
                                <input type='hidden' name='itemPrice' value='".$item['price']."'/>
                                <input type='hidden' name='itemDescription' value='".$item['description']."'/>";
                                echo "<input type='submit' name='updateMenuItem' value='Modify'>";
                                echo "</form>
						</td>";

                    echo "</td>
                    <td>
                        <form method='POST'>
                                <input type='hidden' name='deleteItemName' value='".$item['name']."'/>";
                                echo "<input type='submit' name='deleteMenuItem' value='Delete'>";
                                echo "</form>
                        </td>";

                    echo "</td>
                    <td>
                        <form method='POST'>
                                <input type='hidden' name='flagItemName' value='".$item['name']."'/>";
                                if (strcmp($item['status'], "In Stock") == 0) {
                                    echo "<input type='submit' name='flagSoldOut' value='Sold Out'>";
                                } else {
                                    echo "<input type='submit' name='flagInStock' value='In Stock'>";
                                }
                                echo "</form>
                        </td>";
                echo "</tr>";
        }
        echo "</table>";
    }
?>


</div>
</body>
</html>