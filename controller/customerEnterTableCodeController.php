<?php

class customerEnterTableCodeController {

    public function checkTableCode($code) {
        require_once("./entity/tableCode.php");
		$error = false;
		
		if (empty($code)) {
			$error = true;
			$_SESSION['codeError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['codeError'] = "";
		}

        if (!$error) {
			$tableCode = new tableCode();
            $codeResult = $tableCode->enterTableCode($code);

            return $codeResult;
		}
    }
}