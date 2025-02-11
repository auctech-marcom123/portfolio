<?php include 'check_session.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Vanasthali Group | Admin Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link rel="stylesheet" href="./vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./vendor/owl-carousel/css/owl.theme.default.min.css">
    <link href="./vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">

    <!-- Datatable -->
    <link href="./vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="./css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    label {
        color: #302f2f;
        font-weight: bold;
    }

    .form-control {
        background: #fff;
        border: 1px solid #cbc3c3;
        color: #454545;
        padding: 0.3rem 0.7rem;
    }
    .maxsize{
        margin-top:-1vh;
        font-size:12px;
    }
    .file{
        margin-top:-1vh !important;
    }
    </style>
</head>

<body>
    <?php
            include('header.php');
        ?>
    <!--**********************************
            Sidebar end
        ***********************************-->

    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body" style="background:#93938a29">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-xl-6 col-xxl-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Client Feedback</h4>
                        </div>
                        <hr>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="POST" action="client_feedback_insert.php" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Name</label>
                                            <input type="text" name='name' class="form-control"
                                                placeholder="Enter Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Designation</label>
                                            <input type="text" name="designation" class="form-control"
                                                placeholder="Enter Designation">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Company Name</label>
                                            <input type="text" name='company_name' class="form-control"
                                                placeholder="Enter Banner Title">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Select Rating</label>
                                            <select class="form-control" name="rating" id="type" required>
                                                <option value="" disabled selected>--Select--</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Feedback</label>
                                            <textarea type="text" name='feedback' class="form-control mt-3" rows='3'
                                                placeholder="Enter Client Feedback..."></textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Profile Pic <span class="text-primary">(Resolution:200 × 200)</span></label>
                                            <p class="maxsize">(Maxsize: 91.6 KB)</p>
                                            <input type="file" name="images[]" class="form-control file" id="images" required>
                                        </div>
                                          
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Select Status</label>
                                            <select id="inputState" name="status" class="form-control">
                                                <option selected>--Select--</option>
                                                <option value="1">Publish</option>
                                                <option value="0">Unpublish</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Date</label>
                                            <input type="date" name="date" class="form-control"
                                                placeholder="Enter Date">
                                        </div>
                                    </div>
                                    <div class="form-row">                                       
                                        <div class="form-group col-md-6">
                                            <label>Sequence Number</label>
                                            <input type="number" name="sequence_number" class="form-control"
                                                placeholder="Enter Sequence Number">
                                        </div>
                                        <div class="form-group col-md-6 mt-4">
                                            <button type="submit" name="submit" class="btn btn-primary mt-1">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
            Content body end
        ***********************************-->


    <!--**********************************
            Footer start
        ***********************************-->
   <?php
            include('footer.php');
        ?>