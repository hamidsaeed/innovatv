<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from holaa.codexshaper.com/html/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 11 Jul 2024 12:15:42 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Cart-InnovaTV</title>
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
        <link rel="stylesheet" href="assets/css/rtl-style.html">
    </head>
<body>
    <!-- Start Header -->
    <header class="navbar-area position-relative">
        <!-- Start Breadcrumb Area -->
        <div class="breadcrumb-area position-relative">
            <div class="position-absolute top-50 start-50 translate-middle text-center">
                <h1 class="page-name text-uppercase lh-1 mb-0">Cart Page</h1>
                <ul class="breadcrumb-area--list">
                    <li class="breadcrumb-area--item d-inline-block"><a href="index.html" class="breadcrumb-area--link">Home</a></li>
                    <li class="breadcrumb-area--item d-inline-block">Cart</li>
                </ul>
            </div>
        </div>
        <!-- End Breadcrumb Area -->

<?php
include('headerfront.php')
?>
    <!-- Start Main -->
    <main class="main">
        <div class="registration-area my-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mb-lg-0 mb-4 table-responsive">
                        <div class="holaa-form-wrapper product-cart-wrap">
                            <div class="cart-header">
                                <ul>
                                    <li>Product</li>
                                    <li>Price</li>
                                    <li>Qty</li>
                                    <li>Total</li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li>
                                        <div class="product">
                                            <img src="assets/images/shop/1.png" alt="img">
                                            <div class="details">
                                                <h6>whispers in dark</h6>
                                                <span>Movies offer people in hours</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li> $24.00 </li>
                                    <li>
                                        <div class="quantity">
                                            <input type="number" step="1" min="0" max="100" value="2" title="Qty" class="input-text qty text">
                                        </div>
                                    </li>
                                    <li>$ 48.00</li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="product">
                                            <img src="assets/images/shop/2.png" alt="img">
                                            <div class="details">
                                                <h6>whispers in dark</h6>
                                                <span>Movies offer people in hours</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li> $15.00 </li>
                                    <li>
                                        <div class="quantity">
                                            <input type="number" step="1" min="0" max="100" value="1" title="Qty" class="input-text qty text">
                                        </div>
                                    </li>
                                    <li>$ 15.00</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart-right-form holaa-form-wrapper">
                            <h5 class="title mb-3">Apply coupon code</h5>
                            <div class="input-group cupon-wrap mb-2">
                                <input type="text" class="form-control" placeholder="7BCD123#">
                                <span class="input-group-text">Apply</span>
                            </div>
                            <div class="price-list">
                                <ul>
                                    <li>
                                        Total price
                                        <span class="amount">$ 63.00</span>
                                    </li>
                                    <li>
                                        Coupon price
                                        <span class="amount">$ 14.00</span>
                                    </li>
                                    <li>
                                        <strong>Subtotal Price</strong>
                                        <span class="amount subtotal">$ 49.00</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="btn-wrap">
                                <a href="checkout.php" class="hl-btn medium-btn btn-base text-uppercase lh-1">
                                    <span class="pt-0">Go To Checkout</span>
                                </a>
                            </div>
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

<!-- Mirrored from holaa.codexshaper.com/html/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 11 Jul 2024 12:15:43 GMT -->
</html>