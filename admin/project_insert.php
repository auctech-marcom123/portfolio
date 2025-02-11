<?php
// Include your database connection file
include('../db_con.php');

if (isset($_POST['submit'])) {
    // Start a database transaction
    $con->begin_transaction();

    try {
        // Retrieve form data
        $pro_url_first = $_POST['pro_url'];
        $pro_url = str_replace(' ', '-', $pro_url_first);

        $pro_category = $_POST['pro_category'];
        $industry_name = $_POST['industry_name'];
        $country_name = $_POST['country_name'];
        $year = $_POST['year'];
        $pro_tile = $_POST['pro_tile'];
        $highlight_text = $_POST['highlight_text'];
        $client_name = $_POST['client_name'];
        $website_urls = $_POST['website_urls'];
        $status = $_POST['status'];
        $project_brief = $_POST['project_brief'];
        $created_at = date('Y-m-d');

        // Insert product data into products table
        $sql = "INSERT INTO add_project (pro_url, pro_category, industry_name, country_name, year, pro_tile, highlight_text, client_name, website_urls, status, project_brief, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssssssssss", $pro_url, $pro_category, $industry_name, $country_name, $year, $pro_tile, $highlight_text, $client_name, $website_urls, $status, $project_brief, $created_at);

        if (!$stmt->execute()) {
            throw new Exception("Error inserting project: " . $stmt->error);
        }

        // Get the last inserted product ID
        $project_id = $stmt->insert_id;

        // Handle multiple file uploads for images
        $target_dir = "../project/project_upload/";
        foreach ($_FILES['images']['name'] as $key => $image_name) {
            // Generate unique image name
            $unique_image_name = uniqid() . "_" . basename($image_name);
            $target_file = $target_dir . $unique_image_name;

            // Move the uploaded file to the server
            if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $target_file)) {
                // Insert image data into project_images table
                $sql = "INSERT INTO project_images (project_id, image) VALUES (?, ?)";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("is", $project_id, $unique_image_name);

                if (!$stmt->execute()) {
                    throw new Exception("Error inserting image: " . $stmt->error);
                }
            } else {
                throw new Exception("Error uploading image: $image_name");
            }
        }

        // Handle multiple file uploads for logos (same product_id is used)
        if (isset($_FILES['logos'])) {
            foreach ($_FILES['logos']['name'] as $key => $logo_name) {
                // Generate unique logo name
                $unique_logo_name = uniqid() . "_" . basename($logo_name);

                if ($_FILES['logos']['error'][$key] == 0) {
                    $logo_target_file = $target_dir . $unique_logo_name;

                    // Move the uploaded logo to the server
                    if (move_uploaded_file($_FILES['logos']['tmp_name'][$key], $logo_target_file)) {
                        // Insert logo into project_images table with the same product_id
                        $sql = "INSERT INTO project_images (project_id, logos) VALUES (?, ?)";
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param("is", $project_id, $unique_logo_name);

                        if (!$stmt->execute()) {
                            throw new Exception("Error inserting logo: " . $stmt->error);
                        }
                    } else {
                        throw new Exception("Error uploading logo: $logo_name");
                    }
                } else {
                    throw new Exception("Error uploading logo: " . $_FILES['logos']['error'][$key]);
                }
            }
        }

        // Handle multiple file uploads for two_photos (same product_id is used)
        if (isset($_FILES['two_photos'])) {
            foreach ($_FILES['two_photos']['name'] as $key => $two_name) {
                // Generate unique name for each photo
                $unique_two_name = uniqid() . "_" . basename($two_name);

                if ($_FILES['two_photos']['error'][$key] == 0) {
                    $target_file = $target_dir . $unique_two_name;

                    if (move_uploaded_file($_FILES['two_photos']['tmp_name'][$key], $target_file)) {
                        // Insert photo into project_images table
                        $sql = "INSERT INTO project_images (project_id, two_photos) VALUES (?, ?)";
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param("is", $project_id, $unique_two_name);

                        if (!$stmt->execute()) {
                            throw new Exception("Error inserting photo: " . $stmt->error);
                        }
                    } else {
                        throw new Exception("Error uploading photo: $two_name");
                    }
                } else {
                    throw new Exception("Error uploading photo: " . $_FILES['two_photos']['error'][$key]);
                }
            }
        }

        // Handle multiple file uploads for single_photos (same product_id is used)
        if (isset($_FILES['single_photos'])) {
            foreach ($_FILES['single_photos']['name'] as $key => $single_name) {
                // Generate unique name for each photo
                $unique_single_name = uniqid() . "_" . basename($single_name);

                if ($_FILES['single_photos']['error'][$key] == 0) {
                    $target_file = $target_dir . $unique_single_name;

                    if (move_uploaded_file($_FILES['single_photos']['tmp_name'][$key], $target_file)) {
                        // Insert photo into project_images table
                        $sql = "INSERT INTO project_images (project_id, single_photos) VALUES (?, ?)";
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param("is", $project_id, $unique_single_name);

                        if (!$stmt->execute()) {
                            throw new Exception("Error inserting photo: " . $stmt->error);
                        }
                    } else {
                        throw new Exception("Error uploading photo: $single_name");
                    }
                } else {
                    throw new Exception("Error uploading photo: " . $_FILES['single_photos']['error'][$key]);
                }
            }
        }


        // Commit the transaction
        $con->commit();

        // Redirect to project list
        header('Location: project_list.php');

    } catch (Exception $e) {
        // Rollback transaction if error occurs
        $con->rollback();
        echo "Failed to insert project and images: " . $e->getMessage();
    }

    // Close statement and connection
    $stmt->close();
    $con->close();
}
?>
