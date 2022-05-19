<?php
	session_start();
    
    if (isset($_POST['makePayment'])) {
        header("Location: adminPageUI.php");
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

    <br>

    <?php

	echo "<table border=1px solid black>";
	echo "<tr>
					<th>
						Name
					</th>
                    <th>
						Quantity
					</th>
				</tr>";

            foreach($_SESSION['cart'] as $item => $value) {
                echo "<tr>";
                echo "<td>".$item."</td>";
                echo "<td>".$value."</td>";
                echo "</tr>";
            }

            echo "<tr>
            <td>Total Cost</td><td>" ;
                echo $_SESSION['totalCost'];
            echo "</td>
            </tr>";
				
			echo "</table>";

    ?>

    <form method="POST">
    <table>
        <tr>
            <td><button type="submit" name="makePayment">Make Payment</button></td>
        </tr>
    </table>
    </form>



    </div>
    </body>
</html>