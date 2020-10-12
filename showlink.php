<?php
    require_once("./config.php");

    // SHOW LINKS
    $mysql = new mysqli(HOST, USER, PASSWD, DB);
    if($mysql->connect_error) {
        $backlink_error = "Database Failed to Load";
    }

    if(!isset($backlink_error)) {
        $stmt = $mysql->prepare("SELECT * FROM backlink ORDER BY backlink_id DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            while($backlink = $result->fetch_assoc()) {
                echo "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum nostrum non ratione architecto voluptas saepe deserunt unde suscipit quam totam modi voluptate aliquam enim aliquid sed perferendis, in dolore repellendus!";
                echo " <a href=".$backlink["backlink_url"]." target='_blank'>".$backlink["backlink_url"]."</a> ";
                echo "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum nostrum non ratione architecto voluptas saepe deserunt unde suscipit quam totam modi voluptate aliquam enim aliquid sed perferendis, in dolore repellendus!";
            }
        }
        $stmt->close();
        $mysql->close();
    }
?>