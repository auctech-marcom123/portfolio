<?php 

include('db_con.php');

$industries = [];
$categories = [];
$countries = [];
$years = [];
$industry_counts = [];

$industry_result = $con->query("SELECT industry_name, COUNT(*) as project_count FROM add_project WHERE status = 1 GROUP BY industry_name");
while ($row = $industry_result->fetch_assoc()) {
    $industries[] = $row['industry_name'];
    $industry_counts[$row['industry_name']] = $row['project_count'];
}

$category_result = $con->query("SELECT DISTINCT pro_category FROM add_project WHERE status = 1");
while ($row = $category_result->fetch_assoc()) {
    $categories[] = $row['pro_category'];
}

$country_result = $con->query("SELECT DISTINCT country_name FROM add_project WHERE status = 1");
while ($row = $country_result->fetch_assoc()) {
    $countries[] = $row['country_name'];
}

$year_result = $con->query("SELECT DISTINCT year FROM add_project WHERE status = 1");
while ($row = $year_result->fetch_assoc()) {
    $years[] = $row['year'];
}
?>



<!DOCTYPE html>

<html xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title>Auctech Portfolio</title>

    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- font -->
    <link rel="stylesheet" href="fonts/fonts.css">
    <!-- Icons -->
    <link rel="stylesheet" href="fonts/font-icons.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="../../../sibforms.com/forms/end-form/build/sib-styles.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css" />

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="images/logo/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="images/logo/favicon.png">

    <style>
        @media only screen and (max-width: 767px) {

            .logo-header img {
                width: 110px;
                margin-left: 169%;
                margin-top: 18px;
            }
        }
        .pagination-link{
            background:black;
            color: white !important;
        }
        }
        .tf-grid-layout .wg-pagination {
            grid-column: 3 / -1 !important;
            width: 100%;
        }
                .tf-grid-layout .filters {
            grid-column: 1 / -3;
            width: 60%;
        }
            
        .filters {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
        }

        .filters-container {
            display: flex;
            align-items: center;
        }

        .entries-box {
            margin-right: 20px;
            display: flex;
            align-items: center;
        }

        .entries-dropdown {
            padding: 8px 20px;
            font-size: 18px;
            margin-left: 7px;
        }


        .display-count {
            font-size: 14px;
            color: #555;
        }

        .wg-pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }


        .tf-pagination-list li {
            margin: 0 5px;
        }


        .pagination-link {
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .pagination-link:hover {
            background-color: #007bff;
            color: white;
        }

        .pagination-link.active {
            background-color: #007bff;
            color: white;
        }

        .pagination-prev.disabled,
        .pagination-next.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }


        .pagination-prev a,
        .pagination-next a {
            padding: 8px 12px;
            font-size: 14px;
            text-decoration: none;
            color: #007bff;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .pagination-prev a:hover,
        .pagination-next a:hover {
            background-color: #007bff;
            color: white;
        }

    </style>
    
</head>

<body class="preload-wrapper">
    <!-- preload -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload -->
    <div id="wrapper">
        <!-- header -->
        <?php
            include('header.php');
        ?>
        <!-- /header -->

        <!-- page-title -->
        <div class="tf-page-title" style="background-image: url(images/portfolio-banner.jpg);">
            <div class="container-full">
                <div class="row">
                    <div class="col-12">
                        <div class="heading text-center">Our Projects</div>
                        <p class="text-center text-2 text_black-2 mt_5"></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page-title -->
        <section class="flat-spacing-1">
            <div class="container">
                <div class="tf-shop-control grid-3 align-items-center">
                    <div class="tf-control-filter">
                        <a href="#filterShop" data-bs-toggle="offcanvas" data-bs-target="#sidebarmobile"
                            aria-controls="offcanvasLeft" class="tf-btn-filter">
                            <span class="icon icon-filter"></span><span class="text">Filter</span>
                        </a>
                    </div>
                    <ul class="tf-control-layout d-flex justify-content-center">

                    </ul>

                    <div class="tf-control-sorting d-flex justify-content-end">
                        <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                            <div class="btn-select">
                                <span class="text-sort-value">Project</span>
                                <span class="icon icon-arrow-down"></span>
                            </div>
                            <div class="dropdown-menu">
                                <div class="select-item active" data-filter="status" data-value="1">
                                    <span class="text-value-item">All</span>
                                </div>
                                <div class="select-item" data-filter="feature_status" data-value="1">
                                    <span class="text-value-item">Featured Project</span>
                                </div>
                                <div class="select-item" data-filter="king_status" data-value="1">
                                    <span class="text-value-item">King Project</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tf-row-flex">
                    <aside class="tf-shop-sidebar d-none d-md-block">
                        <!-- Industry Filter -->
                        <div class="widget-facet wd-categories">
                            <div class="facet-title" data-bs-target="#industry" data-bs-toggle="collapse">
                                <span>All Industries</span><span class="icon icon-arrow-up"></span>
                            </div>
                            <div id="industry" class="collapse show">
                                <ul class="list-categoris current-scrollbar mb_36">
                                    <?php foreach ($industries as $industry): ?>
                                    <li class="cate-item">
                                        <a href="#" class="filter-item" data-filter="industry"
                                            data-value="<?php echo strtolower(str_replace(' ', '_', $industry)); ?>">
                                            <span><?php echo $industry; ?></span>&nbsp;<span>(<?php echo $industry_counts[$industry]; ?>)</span>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                        <!-- Category Filter -->
                        <div class="widget-facet">
                            <div class="facet-title" data-bs-target="#category" data-bs-toggle="collapse">
                                <span>Project Category</span><span class="icon icon-arrow-up"></span>
                            </div>
                            <div id="category" class="collapse show">
                                <ul class="widget-iconbox-list mb_36">
                                    <?php foreach ($categories as $category): ?>
                                    <li><a href="#" class="filter-item" data-filter="category"
                                            data-value="<?php echo strtolower(str_replace(' ', '_', $category)); ?>">
                                            <span><?php echo $category; ?></span></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                        <!-- Country Filter -->
                        <div class="widget-facet">
                            <div class="facet-title" data-bs-target="#country" data-bs-toggle="collapse">
                                <span>Country Wise</span><span class="icon icon-arrow-up"></span>
                            </div>
                            <div id="country" class="collapse show">
                                <ul class="widget-iconbox-list mb_36">
                                    <?php foreach ($countries as $country): ?>
                                    <li><a href="#" class="filter-item" data-filter="country"
                                            data-value="<?php echo strtolower(str_replace(' ', '_', $country)); ?>">
                                            <span><?php echo $country; ?></span></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                        <!-- Year Filter -->
                        <div class="widget-facet">
                            <div class="facet-title" data-bs-target="#year" data-bs-toggle="collapse">
                                <span>Year Wise</span><span class="icon icon-arrow-up"></span>
                            </div>
                            <div id="year" class="collapse show">
                                <ul class="widget-iconbox-list mb_36">
                                    <?php foreach ($years as $year): ?>
                                    <li><a href="#" class="filter-item" data-filter="year"
                                            data-value="<?php echo $year; ?>">
                                            <span><?php echo $year; ?></span></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                    </aside>

                    <div class="wrapper-control-shop tf-shop-content">
                      <?php
                        include('db_con.php');

                        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 12; // Default 12 projects per page
                        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                        $offset = ($page - 1) * $limit;

                        
                        $totalQuery = "SELECT COUNT(DISTINCT add_project.id) AS total FROM add_project WHERE add_project.status = 1";
                        $totalResult = $con->query($totalQuery);
                        $totalRow = $totalResult->fetch_assoc();
                        $totalProducts = $totalRow['total'];

                        
                        $sql = "SELECT add_project.year AS year, project_images.image, add_project.pro_tile, add_project.highlight_text, add_project.pro_url, 
                                add_project.industry_name, add_project.pro_category, add_project.country_name, add_project.id, 
                                add_project.status, add_project.king_status, add_project.feature_status
                            FROM add_project
                            INNER JOIN project_images ON add_project.id = project_images.project_id
                            WHERE add_project.status = 1
                            GROUP BY add_project.id
                            LIMIT $limit OFFSET $offset";

                        $result = $con->query($sql);
                    ?>

                    <div class="tf-grid-layout wrapper-shop tf-col-4" id="gridLayout">
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="card-product grid" 
                                data-industry="<?= strtolower(str_replace(' ', '_', $row['industry_name'])); ?>"
                                data-category="<?= strtolower(str_replace(' ', '_', $row['pro_category'])); ?>"
                                data-country="<?= strtolower(str_replace(' ', '_', $row['country_name'])); ?>"
                                data-year="<?= $row['year']; ?>"
                                data-status="<?= $row['status']; ?>"
                                data-feature-status="<?= $row['feature_status']; ?>"
                                data-king-status="<?= $row['king_status']; ?>">

                                <div class="card-product-wrapper">
                                    <?php if ($row['king_status'] == 1): ?>
                                        <div class="king-crown-icon" style="position: absolute; right: 5px; z-index: 10;">
                                            <img width="40" height="40" src="https://img.icons8.com/color/48/fairytale.png" alt="King Crown">
                                        </div>
                                    <?php endif; ?>

                                    <a href="project/<?= $row['pro_url']; ?>" class="product-img">
                                        <?php if ($row['feature_status'] == 1): ?>
                                            <div class="king-crown-icon" style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                                <span class="badge rounded-pill bg-danger">Feature</span>
                                            </div>
                                        <?php endif; ?>

                                       
                                              <img class="lazyload img-product"
                                            data-src="project/project_upload/<?= $row['image']; ?>"
                                            src="project/project_upload/<?= $image; ?>" alt="image-product">
                                        <img class="lazyload img-hover" data-src="project/project_upload/<?= $row['image']; ?>"
                                            src="project/project_upload/<?= $row['image']; ?>" alt="image-product">
                                    </a>
                                </div>
                                <div class="card-product-info">
                                    <a href="project/<?= $row['pro_url']; ?>" class="title link"><?= $row['pro_tile']; ?></a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>

                        <!-- Pagination Controls -->
                        <div class="filters">
                            <div class="entries-box">
                                <label for="entriesPerPage">Show: </label>
                                <select id="entriesPerPage" class="entries-dropdown">
                                    <option value="12" <?= ($limit == 12) ? 'selected' : ''; ?>>12</option>
                                    <option value="24" <?= ($limit == 24) ? 'selected' : ''; ?>>24</option>
                                    <option value="36" <?= ($limit == 36) ? 'selected' : ''; ?>>36</option>
                                </select>
                            </div>
                            <div id="displayCount" style="font-size:19px;">
                                <?= ($offset + 1) . "-" . min($offset + $limit, $totalProducts) . " of " . $totalProducts; ?>
                            </div>
                        </div>

                        <ul id="pagination" class="wg-pagination tf-pagination-list">
                            <?php for ($i = 1; $i <= ceil($totalProducts / $limit); $i++): ?>
                                <li class="pagination-item <?= ($i == $page) ? 'active' : ''; ?>">
                                    <a href="#" class="pagination-link" data-page="<?= $i; ?>"><?= $i; ?></a>
                                </li>
                            <?php endfor; ?>
                        </ul>

                    </div>
                </div>
            </div>
        </section>


        <!-- footer -->
        <?php
        include('footer.php');
       ?>
        <!-- /footer -->

    </div>

    <!-- gotop -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 286.138;">
            </path>
        </svg>
    </div>
    <!-- /gotop -->

    <!-- mobile menu -->
    <div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
        <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
        <div class="mb-canvas-content">
            <div class="mb-body">
                <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                    <li class="nav-mb-item">
                        <a href="project.php" class="mb-menu-link">Project</a>
                    </li>
                    <li class="nav-mb-item">
                        <a href="https://www.auctech.in/" class="mb-menu-link">About Us</a>
                    </li>
                    <li class="nav-mb-item">
                        <a href="contact.php" class="mb-menu-link">Contact</a>
                    </li>
                </ul>
                <div class="mb-other-content">
                    <ul class="mb-info">
                        <li>Address: Flat 101, Shaligram Building,
                            New Jiamau, 1090 Chauraha,
                            <br> Lucknow, Uttar Pradesh 226001.
                        </li>
                        <li>Email: <b>info@auctech.in</b></li>
                        <li>Phone: <b>+91 6386452123, 9838075490</b></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /mobile menu -->

    <!-- Filter -->
    <div class="offcanvas offcanvas-start canvas-filter">
        <div class="canvas-wrapper">
            <header class="canvas-header">
                <div class="filter-icon">
                    <span class="icon icon-filter"></span>
                    <span>Filter</span>
                </div>
                <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
            </header>
            <div class="canvas-body">
                <div class="widget-facet wd-categories">
                    <div class="facet-title" data-bs-target="#categories" data-bs-toggle="collapse" aria-expanded="true"
                        aria-controls="categories">
                        <span>Project categories</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="categories" class="collapse show">

                    </div>
                </div>
                <form action="#" id="facet-filter-form" class="facet-filter-form">
                    <div class="widget-facet">
                        <div class="facet-title" data-bs-target="#availability" data-bs-toggle="collapse"
                            aria-expanded="true" aria-controls="availability">

                            <span class="icon icon-arrow-up"></span>
                        </div>
                        <div id="availability" class="collapse show">

                        </div>
                    </div>
                    <div class="widget-facet">
                        <div class="facet-title" data-bs-target="#price" data-bs-toggle="collapse" aria-expanded="true"
                            aria-controls="price">
                            <span>Price</span>
                            <span class="icon icon-arrow-up"></span>
                        </div>
                        <div id="price" class="collapse show">
                            <div class="widget-price filter-price">
                                <div class="price-val-range" id="price-value-range" data-min="0" data-max="500"></div>
                                <div class="box-title-price">
                                    <span class="title-price">Price :</span>
                                    <div class="caption-price">
                                        <div class="price-val" id="price-min-value" data-currency="$"></div>
                                        <span>-</span>
                                        <div class="price-val" id="price-max-value" data-currency="$"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Filter -->


    <!-- Filter sidebar-->
    <div class="offcanvas offcanvas-start canvas-filter canvas-sidebar" id="sidebarmobile">
        <div class="canvas-wrapper">
            <header class="canvas-header">
                <span class="title">SIDEBAR PROJECT</span>
                <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
            </header>
            <div class="canvas-body sidebar-mobile-append">
                <!-- Industry Filter -->
                <div class="widget-facet wd-categories">
                    <div class="facet-title" data-bs-target="#industry" data-bs-toggle="collapse">
                        <span>All Industries</span><span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="industry" class="collapse show">
                        <ul class="list-categoris current-scrollbar mb_36">
                            <?php foreach ($industries as $industry): ?>
                            <li class="cate-item">
                                <a href="#" class="filter-item" data-filter="industry"
                                    data-value="<?php echo strtolower(str_replace(' ', '_', $industry)); ?>">
                                    <span><?php echo $industry; ?></span>&nbsp;<span>(<?php echo $industry_counts[$industry]; ?>)</span>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <!-- Category Filter -->
                <div class="widget-facet">
                    <div class="facet-title" data-bs-target="#category" data-bs-toggle="collapse">
                        <span>Project Category</span><span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="category" class="collapse show">
                        <ul class="widget-iconbox-list mb_36">
                            <?php foreach ($categories as $category): ?>
                            <li><a href="#" class="filter-item" data-filter="category"
                                    data-value="<?php echo strtolower(str_replace(' ', '_', $category)); ?>">
                                    <span><?php echo $category; ?></span></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <!-- Country Filter -->
                <div class="widget-facet">
                    <div class="facet-title" data-bs-target="#country" data-bs-toggle="collapse">
                        <span>Country Wise</span><span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="country" class="collapse show">
                        <ul class="widget-iconbox-list mb_36">
                            <?php foreach ($countries as $country): ?>
                            <li><a href="#" class="filter-item" data-filter="country"
                                    data-value="<?php echo strtolower(str_replace(' ', '_', $country)); ?>">
                                    <span><?php echo $country; ?></span></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <!-- Year Filter -->
                <div class="widget-facet">
                    <div class="facet-title" data-bs-target="#year" data-bs-toggle="collapse">
                        <span>Year Wise</span><span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="year" class="collapse show">
                        <ul class="widget-iconbox-list mb_36">
                            <?php foreach ($years as $year): ?>
                            <li><a href="#" class="filter-item" data-filter="year" data-value="<?php echo $year; ?>">
                                    <span><?php echo $year; ?></span></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Filter sidebar -->


            <!-- Javascript -->
            <script type="text/javascript" src="js/bootstrap.min.js"></script>
            <script type="text/javascript" src="js/jquery.min.js"></script>
            <script type="text/javascript" src="js/swiper-bundle.min.js"></script>
            <script type="text/javascript" src="js/carousel.js"></script>
            <script type="text/javascript" src="js/bootstrap-select.min.js"></script>
            <script type="text/javascript" src="js/lazysize.min.js"></script>
            <script type="text/javascript" src="js/count-down.js"></script>
            <script type="text/javascript" src="js/wow.min.js"></script>
            <script type="text/javascript" src="js/multiple-modal.js"></script>
            <script type="text/javascript" src="js/nouislider.min.js"></script>
            <script type="text/javascript" src="js/shop.js"></script>
            <script type="text/javascript" src="js/main.js"></script>

            <!-- <script src="js/sibforms.js" defer></script> -->

            <script>
            window.REQUIRED_CODE_ERROR_MESSAGE = 'Please choose a country code';
            window.LOCALE = 'en';
            window.EMAIL_INVALID_MESSAGE = window.SMS_INVALID_MESSAGE =
                "The information provided is invalid. Please review the field format and try again.";

            window.REQUIRED_ERROR_MESSAGE = "This field cannot be left blank. ";

            window.GENERIC_INVALID_MESSAGE =
                "The information provided is invalid. Please review the field format and try again.";

            window.translation = {
                common: {
                    selectedList: '{quantity} list selected',
                    selectedLists: '{quantity} lists selected'
                }
            };

            var AUTOHIDE = Boolean(0);
            </script>
            <script>
            document.addEventListener("DOMContentLoaded", function() {

                function filterProjects() {
                    const selectedFilters = {
                        industry: document.querySelector(
                            "a.filter-item.active[data-filter='industry']")?.getAttribute(
                            "data-value") || "",
                        category: document.querySelector(
                            "a.filter-item.active[data-filter='category']")?.getAttribute(
                            "data-value") || "",
                        country: document.querySelector(
                            "a.filter-item.active[data-filter='country']")?.getAttribute(
                            "data-value") || "",
                        year: document.querySelector("a.filter-item.active[data-filter='year']")
                            ?.getAttribute("data-value") || ""
                    };


                    const projectCards = document.querySelectorAll(".card-product");


                    projectCards.forEach(card => {
                        const industry = card.getAttribute("data-industry");
                        const category = card.getAttribute("data-category");
                        const country = card.getAttribute("data-country");
                        const year = card.getAttribute("data-year");

                        if (
                            (selectedFilters.industry === "" || selectedFilters.industry ===
                                industry) &&
                            (selectedFilters.category === "" || selectedFilters.category ===
                                category) &&
                            (selectedFilters.country === "" || selectedFilters.country ===
                                country) &&
                            (selectedFilters.year === "" || selectedFilters.year === year)
                        ) {
                            card.style.display = "";
                        } else {
                            card.style.display = "none";
                        }
                    });

                    const removeAllButton = document.getElementById("remove-all");
                    if (document.querySelectorAll('.filter-item.active').length > 0) {
                        removeAllButton.style.display = "block";
                    } else {
                        removeAllButton.style.display = "none";
                    }
                }

                document.querySelectorAll(".filter-item").forEach(item => {
                    item.addEventListener("click", function(event) {
                        event.preventDefault();

                        const filterType = this.getAttribute("data-filter");

                        document.querySelectorAll(".filter-item").forEach(otherItem => {
                            if (otherItem !== this) {

                                otherItem.classList.remove("active");
                            }
                        });


                        this.classList.toggle("active");


                        filterProjects();
                    });
                });


                document.getElementById("remove-all")?.addEventListener("click", function() {

                    document.querySelectorAll(".filter-item").forEach(item => item.classList
                        .remove("active"));
                    filterProjects();
                });


                filterProjects();
            });
            </script>
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                function filterProjects(filterType, filterValue) {
                    const projectCards = document.querySelectorAll(".card-product");

                    projectCards.forEach(card => {
                        const featureStatus = card.getAttribute("data-feature-status");
                        const kingStatus = card.getAttribute("data-king-status");

                        if (
                            (filterType === "feature_status" && (filterValue === "" || featureStatus ===
                                filterValue)) ||
                            (filterType === "king_status" && (filterValue === "" || kingStatus ===
                                filterValue)) ||
                            (filterType === "status" && (filterValue === "" || featureStatus ===
                                filterValue || kingStatus === filterValue))
                        ) {
                            card.style.display = "";
                        } else {
                            card.style.display = "none";
                        }
                    });
                }

                document.querySelectorAll(".dropdown-menu .select-item").forEach(item => {
                    item.addEventListener("click", function() {
                        const filterType = this.getAttribute("data-filter");
                        const filterValue = this.getAttribute("data-value");

                        // Update active class
                        document.querySelectorAll(".dropdown-menu .select-item").forEach(i => i
                            .classList.remove("active"));
                        this.classList.add("active");

                        filterProjects(filterType, filterValue);
                    });
                });

                // Default filter to "status" and show all projects
                const defaultFilter = document.querySelector(".dropdown-menu .select-item.active");
                const defaultFilterType = defaultFilter.getAttribute("data-filter");
                const defaultFilterValue = defaultFilter.getAttribute("data-value");

                // Apply the default filter when page loads
                filterProjects(defaultFilterType, defaultFilterValue);
            });
            </script>
            
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                        function loadProducts(page, limit) {
                            fetch(`index.php?page=${page}&limit=${limit}`)
                                .then(response => response.text())
                                .then(data => {
                                    document.getElementById("gridLayout").innerHTML = new DOMParser()
                                        .parseFromString(data, "text/html")
                                        .querySelector("#gridLayout").innerHTML;

                                    document.getElementById("displayCount").innerHTML = new DOMParser()
                                        .parseFromString(data, "text/html")
                                        .querySelector("#displayCount").innerHTML;

                                    updatePagination(page);
                                });
                        }

                        function updatePagination(currentPage) {
                            document.querySelectorAll(".pagination-link").forEach(link => {
                                link.classList.remove("active");
                                if (parseInt(link.dataset.page) === currentPage) {
                                    link.classList.add("active");
                                }
                            });
                        }

                        document.querySelectorAll(".pagination-link").forEach(link => {
                            link.addEventListener("click", function (e) {
                                e.preventDefault();
                                let page = parseInt(this.dataset.page);
                                let limit = parseInt(document.getElementById("entriesPerPage").value);
                                loadProducts(page, limit);
                            });
                        });

                        document.getElementById("entriesPerPage").addEventListener("change", function () {
                            loadProducts(1, parseInt(this.value));
                        });
                    });

            </script>

      
</body>

</html>