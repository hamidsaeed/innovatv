<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from holaa.codexshaper.com/html/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 11 Jul 2024 12:15:39 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Login-InnovaTv</title>
        <meta name="robots" content="noindex, follow">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">

        <!-- CSS -->
        <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/vendor/magnific.css">
        <link rel="stylesheet" href="assets/css/vendor/swiper-bundle.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
<body>
    <!-- Start Header -->
    <header class="navbar-area position-relative">
        <!-- Start Breadcrumb Area -->
        <div class="breadcrumb-area position-relative">
            <div class="position-absolute top-50 start-50 translate-middle text-center">
                <h1 class="page-name text-uppercase lh-1 mb-0">My Account</h1>
                <ul class="breadcrumb-area--list">
                    <li class="breadcrumb-area--item d-inline-block"><a href="index.html" class="breadcrumb-area--link">Home</a></li>
                    <li class="breadcrumb-area--item d-inline-block">Log In</li>
                </ul>
            </div>
        </div>
        <!-- End Breadcrumb Area -->

<?php
include('headerfront.php')
?>     
    <!-- Preloader -->
    <div class="loader-wrapper">
        <div class="loader">
            <span></span>
            <span></span>
            <span></span>
        </div> 
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div> 

    <!-- Start Main -->
    <main class="main">
        <div class="registration-area my-80">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="registration-wrap holaa-form-wrapper">
                            <h5 class="inner-small-title mb-0">Login</h5>
                            <p class="mb-4 pb-2">Welcome! Log in to your account</p>
                            <form action="submit_loginfront.php" method="POST">
                                <label class="single-input-field style-border">
                                    <span>Email Address </span>
                                    <input type="email" name="email" placeholder="Enter your Email Address">
                                </label>
                                <label class="single-input-field style-border">
                                    <span>Password</span>
                                    <input type="password" name="password" placeholder="Password">
                                    <svg class="input-icon" width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.11998 9.8316C6.61803 9.33053 6.3125 8.64962 6.3125 7.88579C6.3125 6.3555 7.54511 5.12201 9.07453 5.12201C9.83138 5.12201 10.528 5.42842 11.0212 5.92949" stroke="#818181" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M11.785 8.37598C11.5825 9.50209 10.6956 10.3908 9.57031 10.595" stroke="#818181" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M4.40889 12.5427C3.02351 11.455 1.85026 9.86624 1 7.88551C1.85899 5.89604 3.0401 4.29853 4.43421 3.2021C5.81959 2.10567 7.41797 1.51031 9.07484 1.51031C10.7413 1.51031 12.3388 2.1144 13.7329 3.21869" stroke="#818181" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15.5773 5.13885C16.1779 5.93674 16.7061 6.8577 17.1504 7.88517C15.4333 11.8632 12.3989 14.2595 9.07556 14.2595C8.3222 14.2595 7.57931 14.1373 6.86523 13.899" stroke="#818181" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15.9614 1L2.19141 14.77" stroke="#818181" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>                                            
                                </label> 
                                <div class="check-btn">
                                    <label class="checkbox-wrap">
                                        <input type="checkbox" id="css" checked>
                                        <span>Remember me</span>
                                    </label>  
                                    <div class="btn-wrap mt-sm-4 pt-lg-3 mt-4">
                                        <button type="submit" class="hl-btn medium-btn btn-base text-uppercase lh-1">
                                            <span class="pt-0">Log In</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End Main -->
    
<?php
include('footerfront.php')
?>
    <!-- Script JS -->
    <script src="assets/js/vendor/jquery.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/fontawesome.min.js"></script>
    <script src="assets/js/vendor/magnefic.min.js"></script>
    <script src="assets/js/vendor/swiper-bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>