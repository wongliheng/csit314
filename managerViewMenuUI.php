<?php
	session_start();
    include('controller/managerViewMenuController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "manager") {
        header("Location: loginUI.php");
    }

    $viewMenu = new managerViewMenuController();
    $menuItem = $viewMenu->requestViewMenu();    
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
            </tr>
        </table>
</div>
<br>
<div class="pageContent">
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
                        <form action='managerUpdateMenuUI.php' method='POST'>
								<input type='hidden' name='itemName' value='".$item['name']."'/>
                                <input type='hidden' name='itemPrice' value='".$item['price']."'/>
                                <input type='hidden' name='itemDescription' value='".$item['description']."'/>";
                                echo "<input type='submit' name='updateMenuItem' value='Modify'>";
                                echo "</form>
						</td>
                </tr>";
        }
        echo "</table>";
    }
?>


</div>
</body>
</html>