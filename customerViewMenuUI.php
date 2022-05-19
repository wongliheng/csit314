<?php
	session_start(); 
    include('controller/customerViewMenuController.php');
    include('controller/customerSearchMenuItemController.php');
    
    $_SESSION['searchEmptyError'] = "";

    if (!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
        $_SESSION['totalCost'] = 0;
    }

    if (isset($_POST['addToOrder'])) {
		$item = ($_POST['name']);
        $price = ($_POST['price']);

        if (!array_key_exists($item, $_SESSION['cart'])) {
            $_SESSION['cart'][$item] = "1";
        } else {
            $quantity = $_SESSION['cart'][$item];
            if (is_numeric($quantity)) {
                ++$quantity;
                $_SESSION['cart'][$item] = $quantity;
            }
        }

        $currentCost = $_SESSION['totalCost'];
        $_SESSION['totalCost'] = $currentCost + $price;

        // if (array_key_exists("totalCost", $_SESSION['cart'])) {
        //     $currentCost = $_SESSION['cart']['totalCost'];
        //     $_SESSION['cart']['totalCost'] = $currentCost + $price;
        // } else {
        //     $_SESSION['cart']['totalCost'] = $price;
        // }
	}

    if (isset($_POST['searchMenu'])) {
		$item = ($_POST['searchMenuItem']);

        $searchMenu = new customerSearchMenuItemController();
		$menuItem = $searchMenu->search($item);
        if (empty($menuItem)) {
            $_SESSION['searchEmptyError'] = "Nothing found.";
        }
	} else {
        $viewMenu = new customerViewMenuController();
        $menuItem = $viewMenu->requestViewMenu();
    }

    if (isset($_POST['reset'])) {
        header("Location: customerViewMenuUI.php");
    }
?>

<html>
    <head>
        <title>Restaurant Menu</title>
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
                <th><a href="adminLoginUI.php">Staff Login</a></th>
            </tr>
        </table>
    </div>

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

    <br>

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
						Image
					</th>
				</tr>";
			foreach ($menuItem as $item) {
				echo "<tr>
						<td>".$item['name']."</td>
                        <td>$".$item['price']."</td>
                        <td>".$item['description']."</td>";
                        $imagelink = $item['image'];
                        echo "<td><img src='images/".$imagelink."'>";
                        echo "</td>
                        <td>
                        <form method='POST'>
                            <input type='hidden' name='name' value='".$item['name']."'/>
                            <input type='hidden' name='price' value='".$item['price']."'/>
                            <input type='submit' name='addToOrder' value='Add To Order'>
                        </form>
                        </td>
					</tr>";
			}
			echo "</table>";
        }
            // unset($_SESSION['cart']);
?>

    </div>
    </body>
</html>