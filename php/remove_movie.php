<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $title = $_POST['title'];
    $table = $_POST['tableName'];

    $query = "DELETE FROM $table WHERE Title = '$title' AND user_id = '$user_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to remove movie from watching list']);
    }
}
?>
