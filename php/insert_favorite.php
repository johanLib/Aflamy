<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    $user_id = $data['user_id'];
    $poster = $data['poster'];
    $title = $data['title'];
    $rating = $data['rating'];

    $sanitized_user_id = mysqli_real_escape_string($con, $user_id);
    $sanitized_poster = mysqli_real_escape_string($con, $poster);
    $sanitized_title = mysqli_real_escape_string($con, $title);
    $sanitized_rating = mysqli_real_escape_string($con, $rating);

    $exist = "SELECT Id FROM favorites  WHERE Title = '$sanitized_title' AND user_id = '$user_id'";
    $result_exist = mysqli_query($con, $exist);
    if (mysqli_num_rows($result_exist) > 0) {
        echo json_encode(array("status" => "duplicate", "message" => "This movie is already in your Favorites!"));      
    } else {
        $insert = "INSERT INTO favorites (Poster, Title, Rating, user_id) VALUES ('$sanitized_poster', '$sanitized_title', '$sanitized_rating', '$sanitized_user_id')";
        if (mysqli_query($con, $insert)){
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "error", "message" => mysqli_error($con)));
        }  
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request method"));
}
?>
