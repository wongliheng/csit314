<?php
    session_start();
    include('controller/customerEnterTableCodeController.php'); 

    $_SESSION['couponActive'] = false;
    $_SESSION['codeError'] = "";

    if (isset($_SESSION['tableCode'])) {
        header("Location: customerViewMenuUI.php");
    }

    if (isset($_POST['enterTableCode'])) {
		$code = ($_POST['tableCode']);

        $enterTableCode = new customerEnterTableCodeController();
		$codeResult = $enterTableCode->checkTableCode($code);
        if ($codeResult) {
            header("Location: customerViewMenuUI.php");
            $_SESSION['tableCode'] = $code;

            date_default_timezone_set("Asia/Singapore"); 
            $timestamp = date("Y-m-d H:i");
            $_SESSION['startTime'] = $timestamp;
        }

	}
?>

<html>
    <head>
        <title>Enter Table Code</title>
        <link rel="stylesheet" href="menu.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
    </head>
    <body>
    <div class="header">
        <table>
            <tr>
                <th><a href="customerHomeUI.php">Home</a></th>
                <th><a href="loginUI.php">Staff Login</a></th>
            </tr>
        </table>
    </div>

    <div class="pageContent">

    <form method="POST">
    <table>
        <tr>
            <td>Enter Table Code to Start Ordering</td>
        </tr>
        <tr>
            <td><input type="text" name="tableCode" placeholder="Code"></td>
        </tr>
        <tr>
            <td><button type="submit" name="enterTableCode">Enter</button></td>
        </tr>
        <tr>
            <td><span class="error"><?php echo $_SESSION['codeError'];?></span></td>
        </tr>
    </table>
    </form>
    

    </div>
    </body>
</html>