<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "innovatv_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if post ID is set in the URL
if (isset($_GET['id'])) {
    $post_id = intval($_GET['id']); // Convert to integer for safety

    if ($post_id > 0) {
        // Prepare SQL statement
        $sql = "SELECT * FROM posts WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $post = $result->fetch_assoc();

        // Check if the post exists
        if ($post === null) {
            die("Post not found or query failed.");
        }
    } else {
        die("Invalid post ID.");
    }
} else {
    die("Post ID not provided in the URL.");
}


// Fetch comments
$sql_comments = "SELECT * FROM comments WHERE post_id = ?";
$stmt_comments = $conn->prepare($sql_comments);
$stmt_comments->bind_param("i", $post_id);
$stmt_comments->execute();
$comments = $stmt_comments->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vendor/magnific.css">
    <link rel="stylesheet" href="assets/css/vendor/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="navbar-area position-relative">
<?php
include('headerfront.php')
?>
<!-- Main Content -->
<main>
    <div class="blog-details-area py-80">
        <div class="container">
            <div class="row">
                <div class="col-xxl-9 col-lg-8">
                    <div class="blog blog-details">
                        <div class="thumb position-relative">
                        <img src="assets/images/blog/<?php echo htmlspecialchars($post['image']); ?>" alt="blog">
                        <div class="badge detalis position-absolute bottom-0 bg-body p-2">
                                <div class="type lh-1 p-2"><?php echo htmlspecialchars($post['category']); ?></div>
                            </div>
                        </div>
                        <div class="content px-0">
                            <div class="d-flex align-items-center gap-sm-4 gap-2 fs-18 mb-3 lh-1">
                                <div class="d-inline-flex align-items-center gap-1">
                                    <div class="author-name text-uppercase"><?php echo htmlspecialchars($post['author']); ?></div>
                                </div>
                                <div>/</div>
                                <div class="d-inline-flex align-items-center gap-1">
                                    <div class="time ms-1 flex-shrink-0 text-uppercase"><?php echo date('d M Y', strtotime($post['date_posted'])); ?></div>
                                </div>
                            </div>
                            <h3 class="blog-title text-uppercase mb-3">
                                <a href="#" class="gradient-link fw-medium">
                                    <?php echo htmlspecialchars($post['title']); ?>
                                </a>
                            </h3>
                            <p class="text-block">
                                <?php echo nl2br(htmlspecialchars($post['content'])); ?>
                            </p>
                            <!-- Comment Section -->
                            <div class="comment-area">
                                <h3 class="section-title lh-1 mb-3">Comments</h3>
                                <ul class="comment-list">
                                    <?php while ($comment = $comments->fetch_assoc()): ?>
                                        <li class="comment-item">
                                            <div class="comment d-md-flex align-items-center gap-4">
                                                <div class="thumb flex-shrink-0 mb-lg-0 mb-4">
                                                    <!-- Add an avatar image if available -->
                                                </div>
                                                <div class="content flex-grow-1">
                                                    <div class="header d-md-flex align-items-center justify-content-between">
                                                        <h5 class="visitor-name text-uppercase lh-1 mt-1 mb-0"><?php echo htmlspecialchars($comment['name']); ?></h5>
                                                    </div>
                                                    <p class="fw-medium mb-0">
                                                        <?php echo nl2br(htmlspecialchars($comment['message'])); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                            <!-- Comment Reply Area -->
                            <div class="comment-reply-area mt-40">
                                <h3 class="section-title lh-1 mb-0">Leave A Reply</h3>
                                <p>Your email address will not be published. Required fields are marked *</p>
                                <form class="cmnt-reply-form mt-30" action="submit_comment.php" method="post">
                                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                    <div class="d-block d-sm-flex align-items-center justify-content-between gap-2 gap-lg-4 mb-4">
                                        <label for="name" class="w-100">
                                            <span class="d-inline-block mb-2">Full Name</span>
                                            <input type="text" id="name" name="name" placeholder="Enter Your Name" required class="hl-input-field cmnt-reply-field d-inline-block w-100">
                                        </label>
                                        <label for="email" class="w-100 mt-sm-0 mt-4">
                                            <span class="d-inline-block mb-2">Email</span>
                                            <input type="email" id="email" name="email" placeholder="Enter Your Mail" required class="hl-input-field cmnt-reply-field d-inline-block w-100">
                                        </label>
                                    </div>
                                    <label for="message" class="w-100">
                                        <span class="d-inline-block mb-2">Write your message</span>
                                        <textarea id="message" name="message" rows="3" placeholder="Write your message" required class="hl-input-field cmnt-reply-field d-inline-block w-100"></textarea>
                                    </label>
                                    <div class="position-relative z-1">
                                        <button type="submit" class="hl-btn big-btn btn-base text-uppercase lh-1 mt-3">
                                            <span>Submit</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Blog Side Bar -->
                <!-- Add dynamic sidebar content if needed -->
            </div>
        </div>
    </div>
</main>
<!-- Start Footer -->
<footer>
    <?php
    include('footerfront.php')
    ?>
</footer>
</body>
</html>
<?php
$conn->close();
?>
