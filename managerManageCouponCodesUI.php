<?php
	session_start();
    include('controller/managerViewCouponCodesController.php');
    include('controller/managerDeleteCouponCodesController.php');
    include('controller/managerSearchCouponCodeController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "manager") {
        header("Location: loginUI.php");
    }

    $viewCodesController = new managerViewCouponCodesController();
    $couponCodes = $viewCodesController->requestCouponCodes();

    if (isset($_POST['deleteCouponCode'])) {
		$pkey = ($_POST['deleteCodePkey']);

		$deleteCodeController = new managerDeleteCouponCodesController();
		$deleteResult = $deleteCodeController->deleteCode($pkey);
        
        if ($deleteResult) {
            header("Location: managerManageCouponCodesUI.php");
        }
	}

    if (isset($_POST['searchCodes'])) {
		$item = ($_POST['searchCode']);

        $searchController = new managerSearchCouponCodeController();
		$couponCodes = $searchController->search($item);
        if (empty($couponCodes)) {
            $_SESSION['searchEmptyError'] = "Nothing found.";
        }
	} else {
        $viewCodesController = new managerViewCouponCodesController();
        $couponCodes = $viewCodesController->requestCouponCodes();
    }

    if (isset($_POST['reset'])) {
        header("Location: managerManageCouponCodesUI.php");
    }

?>

<html>
    <head>
        <title>Manage Coupon Codes</title>
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

<form action="managerCreateCouponCodesUI.php">
    <input type="submit" value="Create new coupon code">
</form>

<table>
        <tr>
        <form method="POST">
            <td><input type="text" name="searchCode" placeholder="Search for code"></td>
            <td><button type="submit" name="searchCodes">Search</button></td>
        </form>
        </tr>
        <tr>
            <td><span class="error"><?php echo $_SESSION['searchEmptyError'];?></td>
        </tr>
        <tr>
            <td>
            <form method="POST">
                <button type="submit" name="reset">View all codes</button>
            </form>
            </td>
        </tr>
</table>
<?php

if (!empty($couponCodes)){
echo "<table class=menuTable>";
echo "<tr>
                <th>
                    Coupon Code
                </th>
                <th>
                    Discount
                </th>
            </tr>";
        foreach ($couponCodes as $code) {
            echo "<tr>
                    <td>".$code['code']."</td>
                    <td>".$code['discount']."%</td>";
                    echo "<td>
                        <form action='managerUpdateCouponCodesUI.php' method='POST'>
                                <input type='hidden' name='pkey' value='".$code['pkey']."'/>
								<input type='hidden' name='code' value='".$code['code']."'/>
                                <input type='hidden' name='discount' value='".$code['discount']."'/>";
                                echo "<input type='submit' value='Modify'>";
                                echo "</form>
						</td>";

                    echo "</td>
                    <td>
                        <form method='POST'>
                                <input type='hidden' name='deleteCodePkey' value='".$code['pkey']."'/>";
                                echo "<input type='submit' name='deleteCouponCode' value='Delete'>";
                                echo "</form>
                        </td>";

                echo "</tr>";
        }
        echo "</table>";
} else {
    echo "There are no coupon codes.";
}

?>


</div>
</body>
</html>