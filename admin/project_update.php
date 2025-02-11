<?php
// Include your database connection file
include('../db_con.php');

if (isset($_POST['submit'])) {
    // Start a database transaction
    $con->begin_transaction();

    try {
        // Retrieve form data
        $id = $_POST['id']; // Assuming you are passing the project ID in the form
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
        $create_at = date('Y-m-d');

        // Prepare SQL statement for updating the project
        $sql = "UPDATE add_project SET 
                pro_url = ?, 
                pro_category = ?, 
                industry_name = ?, 
                country_name = ?, 
                year = ?, 
                pro_tile = ?, 
                highlight_text = ?, 
                client_name = ?, 
                website_urls = ?, 
                status = ?, 
                project_brief = ?, 
                created_at = ? 
                WHERE id = ?";

        // Prepare the statement
        if (!$stmt = $con->prepare($sql)) {
            throw new Exception("Error preparing SQL query: " . $con->error);
        }

        // Bind parameters
        $stmt->bind_param("ssssssssssssi", $pro_url, $pro_category, $industry_name, $country_name, $year, $pro_tile, $highlight_text, $client_name, $website_urls, $status, $project_brief, $create_at, $id);

        // Execute the query
        if (!$stmt->execute()) {
            throw new Exception("Error updating project: " . $stmt->error);
        }

        // Handle multiple file uploads for images (delete old and update with new)
        $target_dir = "../project/project_upload/";

        // Step 1: Delete old images from the database
        $sql_delete_images = "DELETE FROM project_images WHERE project_id = ?";
        if (!$stmt_delete_images = $con->prepare($sql_delete_images)) {
            throw new Exception("Error preparing SQL query to delete old images: " . $con->error);
        }
        $stmt_delete_images->bind_param("i", $id);
        if (!$stmt_delete_images->execute()) {
            throw new Exception("Error deleting old images: " . $stmt_delete_images->error);
        }

        // Optionally, delete the physical files from the server
        // Example (you may want to loop through old image names and delete the files from the directory):
        // Example: unlink($target_dir . $existing_image_name);

        // Step 2: Insert new images into the database
        if (isset($_FILES['images'])) {
            foreach ($_FILES['images']['name'] as $key => $image_name) {
                $unique_image_name = uniqid() . "_" . basename($image_name);
                $target_file = $target_dir . $unique_image_name;

                // Move the uploaded image to the server
                if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $target_file)) {
                    // Insert the new image record in the project_images table
                    $sql_insert_image = "INSERT INTO project_images (project_id, image) VALUES (?, ?)";
                    if (!$stmt_insert_image = $con->prepare($sql_insert_image)) {
                        throw new Exception("Error preparing SQL query for image insert: " . $con->error);
                    }
                    $stmt_insert_image->bind_param("is", $id, $unique_image_name);

                    if (!$stmt_insert_image->execute()) {
                        throw new Exception("Error inserting image: " . $stmt_insert_image->error);
                    }
                } else {
                    throw new Exception("Error uploading image: $image_name");
                }
            }
        }

        // Step 3: Handle logo uploads (same process: delete old logos, insert new ones)
        if (isset($_FILES['logos'])) {
            foreach ($_FILES['logos']['name'] as $key => $logo_name) {
                $unique_logo_name = uniqid() . "_" . basename($logo_name);

                // Check if logo upload was successful
                if ($_FILES['logos']['error'][$key] == 0) {
                    $logo_target_file = $target_dir . $unique_logo_name;

                    // Move the logo to the server
                    if (move_uploaded_file($_FILES['logos']['tmp_name'][$key], $logo_target_file)) {
                        // Insert the new logo record
                        $sql_insert_logo = "INSERT INTO project_images (project_id, logos) VALUES (?, ?)";
                        if (!$stmt_insert_logo = $con->prepare($sql_insert_logo)) {
                            throw new Exception("Error preparing SQL query for logo insert: " . $con->error);
                        }
                        $stmt_insert_logo->bind_param("is", $id, $unique_logo_name);

                        if (!$stmt_insert_logo->execute()) {
                            throw new Exception("Error inserting logo: " . $stmt_insert_logo->error);
                        }
                    } else {
                        throw new Exception("Error uploading logo: $logo_name");
                    }
                } else {
                    throw new Exception("Error uploading logo: " . $_FILES['logos']['error'][$key]);
                }
            }
        }

        // Step 4: Handle updates for other types of images (e.g., 'two_photos', 'single_photos', etc.)
        $image_types = ['two_photos', 'single_photos'];
        foreach ($image_types as $image_type) {
            if (isset($_FILES[$image_type])) {
                foreach ($_FILES[$image_type]['name'] as $key => $file_name) {
                    $unique_image_name = uniqid() . "_" . basename($file_name);
                    $target_file = $target_dir . $unique_image_name;

                    // Check for file upload errors
                    if ($_FILES[$image_type]['error'][$key] == 0) {
                        if (move_uploaded_file($_FILES[$image_type]['tmp_name'][$key], $target_file)) {
                            // Insert new image entry
                            $sql_insert_image = "INSERT INTO project_images (project_id, $image_type) VALUES (?, ?)";
                            if (!$stmt_insert_image = $con->prepare($sql_insert_image)) {
                                throw new Exception("Error preparing SQL query for $image_type insert: " . $con->error);
                            }
                            $stmt_insert_image->bind_param("is", $id, $unique_image_name);

                            if (!$stmt_insert_image->execute()) {
                                throw new Exception("Error inserting photo for $image_type: " . $stmt_insert_image->error);
                            }
                        } else {
                            throw new Exception("Error uploading $image_type: $file_name");
                        }
                    } else {
                        throw new Exception("Error uploading $image_type: " . $_FILES[$image_type]['error'][$key]);
                    }
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
        echo "Failed to update project and images: " . $e->getMessage();
    }

    // Close statement and connection
    $stmt->close();
    $con->close();
}
?>
