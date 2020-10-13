<?php
    require_once("./config.php");

    // CHECKING COOKIE
    if(isset($_GET["backlink"]) AND isset($_GET["passwd"])) {
        // GETTING COOKIE
        $backlink_url = $_GET["backlink"];
        $backlink_passwd = $_GET["passwd"];

        // VALIDATING INPUT
        if(!filter_var($backlink_url, FILTER_VALIDATE_URL)) {
            $backlink_error = "Invalid Input Provided";
        }

        // VALIDATING INPUT
        if(!preg_match("/^[a-zA-Z0-9]{2,20}$/", $backlink_passwd)) {
            $backlink_error = "Invalid Input Provided";
        }

        if($backlink_passwd != SCRIPTPASS) {
            $backlink_error = "Invalid Passwd";
        }

        // DATABASE INITIALIZATION
        if(!isset($backlink_error)) {
            $mysql = new mysqli(HOST, USER, PASSWD, DB);
            if($mysql->connect_error) {
                $backlink_error = "Database Failed to Load";
            }
        }
        
        // PROCESSING
        if(!isset($backlink_error)) {
            // DEFAULT VALUE
            $backlink_date = date("d/m/yy h:i:s A");
            $backlink_status = 1;
            
            // CHECK URL EXISTS
            $stmt = $mysql->prepare("SELECT backlink_id, backlink_url FROM backlink WHERE backlink_url = ?");
            $stmt->bind_param("s", $backlink_url);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0) {
                $backlink_error = "URL Already Exists";
                $stmt->close();
                $mysql->close();
            }
        }

        // Inserting URL
        if(!isset($backlink_error)) {
            $stmt  = $mysql->prepare("INSERT INTO backlink (backlink_url, backlink_date, backlink_status) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $backlink_url, $backlink_date, $backlink_status);
            $stmt->execute();
            echo "<script>alert('Link Published')</script>";
            $stmt->close();
            $mysql->close();
        }
    }
    echo "Go to Home Page";
?>