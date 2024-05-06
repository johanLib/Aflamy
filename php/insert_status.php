<?php
include("config.php");

function doesExist($table, $poster, $title, $rating, $user_id) {
    global $con;
    $exist = "SELECT Id FROM $table WHERE Title = '$title' AND user_id = '$user_id'";
    $result_exist = mysqli_query($con, $exist);
    if(mysqli_num_rows($result_exist) > 0) {
        return "duplicate";
    } else {
        return "INSERT INTO $table (Poster, Title, Rating, user_id) VALUES ('$poster', '$title', '$rating', '$user_id')";
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    $user_id = mysqli_real_escape_string($con, $data['user_id']);
    $poster = mysqli_real_escape_string($con, $data['poster']);
    $title = mysqli_real_escape_string($con, $data['title']);
    $rating = mysqli_real_escape_string($con, $data['rating']);
    $options = $data['options'];

    if (!empty($options)) {
        $response = array();
        foreach($options as $option) {
            $option = mysqli_real_escape_string($con, $option);
            $insert = "";
            switch($option) {
                case "Completed":
                case "Watching":
                case "On Hold":
                case "Dropped":
                case "To Watch":
                    $insert = doesExist(strtolower(str_replace(" ", "", $option)), $poster, $title, $rating, $user_id);
                    if ($insert == "duplicate") {
                        $response = array("status" => "duplicate", "message" => "The movie is in your $option list");
                    } else {
                        if(mysqli_query($con, $insert)) {
                            $response = array("status" => "success");
                        } else {
                            $response = array("status" => "error", "message" => mysqli_error($con));
                        }
                    }
                    break;
            }
        }
        echo json_encode($response);
    } else {
        echo json_encode(array("status" => "empty", "message" => "Empty Status!"));
    }
} else {
    echo json_encode(array("status" => "Error", "message" => "Invalid Request Method"));
}
?>
