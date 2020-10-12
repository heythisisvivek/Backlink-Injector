<?php
    require_once("./config.php");

    // CHECKING COOKIE
    if(!isset($_COOKIE["backlink"]) AND empty($_COOKIE["backlink"])) {
        // INITIALIZING COOKIE
        setcookie("backlink", 0, time() + 60 * 60 * 24 * 14, "/");
    } else {
        // GETTING COOKIE
        $backlink_url = $_COOKIE["backlink"];

        // CHECKING COOKIE IS SET
        if(!$backlink_url) {
            $backlink_error = "Backlink Not Set";
        }

        // VALIDATING INPUT
        if(!filter_var($backlink_url, FILTER_VALIDATE_URL)) {
            $backlink_error = "Invalid Input Provided";
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
            $stmt->close();
            $mysql->close();
        }
    }

    echo "Go to Home Page";
?>