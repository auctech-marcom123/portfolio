<?php
include '../db_con.php';

if (isset($_POST['project_ids']) && isset($_POST['status'])) {
    $project_ids = intval($_POST['project_ids']);
    $status = intval($_POST['status']);  

   
    $update_query = "UPDATE  add_feature_product SET status = $status WHERE id = $project_ids";
    
    if ($con->query($update_query)) {
        echo json_encode(['status' => 'success', 'message' => 'Status updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update status']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing required parameters']);
}
?>
