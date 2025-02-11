<?php
if (isset($_POST['name'], $_POST['phone'], $_POST['email'], $_POST['message'])) {
    // Sanitize input (you can expand sanitization for your specific needs)
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    $added_date = date('Y-m-d H:i:s');

    if (empty($name) || empty($phone) || empty($email) || empty($message)) {
        echo 'error';
        exit;
    }
    include('db_con.php');

    $sql = "INSERT INTO contact (name, phone, email, message, added_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);

  
    if ($stmt === false) {
        echo 'error: ' . $con->error;
        exit;
    }

    $stmt->bind_param("sssss", $name, $phone, $email, $message, $added_date);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error: ' . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
?>
