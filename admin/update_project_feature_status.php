<?php
include '../db_con.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['project_id']) && isset($data['feature_status'])) {
    $project_id = $data['project_id'];
    $feature_status = $data['feature_status'];

    $update_query = "UPDATE add_project SET feature_status = $feature_status WHERE id = $project_id";
    if (mysqli_query($con, $update_query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
