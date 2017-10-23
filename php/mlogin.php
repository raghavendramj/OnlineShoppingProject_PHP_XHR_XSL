<?php
error_reporting(E_ALL);

if (count($_GET)) {
    // Parse manager.txt
    $loginData = file('../../data/manager.txt');
    $accessData = array();
    foreach ($loginData as $line) {
        list ($username, $password) = explode(',', $line);
        $accessData[trim($username)] = trim($password);
        //echo "Current Key: ".$username."<br/>";
        //echo "Current Password: ".$password."<br/>";
    }
    // Parse form input
    $mid = isset($_GET['managername']) ? $_GET['managername'] : '';
    $mpassword = isset($_GET['mpassword']) ? $_GET['mpassword'] : '';
    
    if (array_key_exists($mid, $accessData) && $mpassword == $accessData[$mid]) {
        session_start();
        //echo "Matching";
            $_SESSION['managername'] = $_GET['managername'];
        session_write_close();
        echo "success";
    } else {
        echo "Invalid username and/or password";
    }
}
?>