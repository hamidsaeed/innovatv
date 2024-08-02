<?php
// Connect to the database
$connection = new mysqli("localhost", "root", "", "innovatv_db");

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch blog posts including the id
$sql = "SELECT id, title, image, author, date, content FROM blog_posts";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vendor/magnific.css">
    <link rel="stylesheet" href="assets/css/vendor/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="navbar-area position-relative">
    <!-- Start Breadcrumb Area -->
    <div class="breadcrumb-area position-relative">
        <div class="position-absolute top-50 start-50 translate-middle text-center">
            <h1 class="page-name text-uppercase lh-1 mb-0">Blog</h1>
            <ul class="breadcrumb-area--list">
                <li class="breadcrumb-area--item d-inline-block"><a href="index.html" class="breadcrumb-area--link">Home</a></li>
                <li class="breadcrumb-area--item d-inline-block">Blog</li>
            </ul>
        </div>
    </div>
    <!-- End Breadcrumb Area -->
    <!-- Start Popup Mobile Menu  -->
    <div id="sidebar-menu" class="popup_mobile_menu">
        <div class="menu">
            <div class="menu__top">
                <div class="menu_header d-flex align-items-center justify-content-between">
                    <div class="logo">
                        <a class="main-logo me-lg-5 me-4" href="index.php">
                            <img src="assets/images/logo.svg" alt="img">
                        </a>
                    </div>
                    <div class="close_button d-flex align-items-center justify-content-center">
                        <button class="close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="menu__content mobile_menu_nav">
                <div class="d-block">
                    <div class="menu-main-menu-container">
                        <ul id="menu-main-menu" class="menu_list">
                            <!-- Menu items here -->
                        </ul>
                    </div>
                </div>
            </div>
            <!-- social share area -->
            <div class="social_share mt-auto">
                <ul class="social_share__list d-flex align-items-center m-0 p-0">
                    <!-- Social links here -->
                </ul>
            </div>
        </div>
    </div>
</header>
<main class="main">
    <div class="blog-area py-80">
        <div class="container">
            <div class="row">
                <div class="col-xxl-9 col-lg-8">
                    <ul class="blog-wrapper">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<li class="blog bg-primary">';
                                echo '    <div class="thumb position-relative">';
                                echo '        <a href="#"><img src="' . $row['image'] . '" alt="blog"></a>';
                                echo '    </div>';
                                echo '    <div class="content">';
                                echo '        <div class="d-flex align-items-center gap-4 fs-18 mb-3 lh-1">';
                                echo '            <div class="d-inline-flex align-items-center gap-1">';
                                echo '                <img src="assets/images/icons/profile-icon.svg" alt="author">';
                                echo '                <div class="author-name text-uppercase">' . $row['author'] . '</div>';
                                echo '            </div>';
                                echo '            <div class="d-inline-flex align-items-center gap-1">';
                                echo '                <img src="assets/images/icons/clock-tranparent.svg" alt="time">';
                                echo '                <div class="time ms-1 flex-shrink-0 text-uppercase">' . $row['date'] . '</div>';
                                echo '            </div>';
                                echo '        </div>';
                                echo '        <h3 class="blog-title text-uppercase mb-3">';
                                echo '            <a href="blog_details.php?id=' . $row['id'] . '" class="gradient-link fw-medium">';
                                echo '                ' . $row['title'];
                                echo '            </a>';
                                echo '        </h3>';
                                echo '        <a href="blog_details.php?id=' . $row['id'] . '" class="hl-btn gradient-border-button text-uppercase">';
                                echo '            <span>Read more</span>';
                                echo '        </a>';
                                echo '    </div>';                                
                                echo '</li>';
                            }
                        } else {
                            echo "<p>No posts found</p>";
                        }
                        ?>
                    </ul>

                    <!-- Pagination Buttons -->
                    <ul class="hl-pagination mt-40 justify-content-start">
                        <li class="hl-pagination--item">
                            <button class="hl-pagination--button current">01</button>
                        </li>
                        <li class="hl-pagination--item">
                            <button class="hl-pagination--button">02</button>
                        </li>
                        <li class="hl-pagination--item">
                            <button class="hl-pagination--button">03</button>
                        </li>
                        <li class="hl-pagination--item">
                            <button class="hl-pagination--button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="19" viewBox="0 0 28 19" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.49 0.196115C18.2638 1.3274 18.3963 3.13433 19.5707 4.7971C20.7361 6.44723 22.973 8.01774 27.0705 8.60308L27 9.09638V9.0997L27.0705 9.59299C22.973 10.1783 20.7361 11.7488 19.5707 13.399C18.3963 15.0617 18.2638 16.8687 18.49 18L17.5095 18.1961C17.2357 16.8274 17.4033 14.7343 18.7539 12.8221C19.6399 11.5675 21.016 10.4172 23.0581 9.59804H0V8.59804H23.0581C21.016 7.77883 19.6399 6.62854 18.7539 5.37401C17.4033 3.46179 17.2357 1.36872 17.5095 0L18.49 0.196115Z" fill="currentColor"/>
                                </svg>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="col-xxl-3 col-lg-4">
                    <!-- Sidebar content here -->
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>

<?php
// Close the connection
$connection->close();
?>
