<?php

require 'connection.php';
$conn = getDB();
session_start();

if (isset($_GET["travel_no"])) {
    $sql = "SELECT * FROM travels WHERE travel_no = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $_GET["travel_no"]);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            $travel = mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
    if ($travel) {
        $travel_no = $travel["travel_no"];
    } else {
        die("travel not found");
    }
} else {
    header("Refresh:2; url=user_home.php");  
    exit();
}

// Add new reservation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["comment_text"] == "") {
        $errors[] = "Content is required";
    }

    if (empty($errors)) {
        $sql = "CALL insert_res(?, ?, ?, ?);";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            echo mysqli_error($conn);
        } else {
            mysqli_stmt_bind_param(
                $stmt,
                "ssii",
                $_POST["comment_text"],
                $_POST["ticket_no"],
                $user_id
            );
            if (mysqli_stmt_execute($stmt)) {
                $id = mysqli_insert_id($conn);

                redirect("/ccis/user/home.php");
            } else {
                echo mysqli_stmt_error($stmt);
            }
        }
    }
}

?>