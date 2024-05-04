<?php 

include("config.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    $title = mysqli_real_escape_string($con, $data['title']);
    $rating = mysqli_real_escape_string($con, $data['rating']);

    // Check if the record exists
    $exist = "SELECT Id FROM completed WHERE Title = '$title'";
    $result_exist = mysqli_query($con, $exist);

    if(mysqli_num_rows($result_exist) > 0) {
        // Update the record in the completed table
        $edit = "UPDATE completed SET Rating = '$rating' WHERE Title = '$title'";
        if(mysqli_query($con, $edit)) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "error", "message" => mysqli_error($con)));
        }
    } else {
        echo json_encode(array("status" => "notWatched", "message" => "You haven't watched this movie!"));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid Request Method"));
}

?>
