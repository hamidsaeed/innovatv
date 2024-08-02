<?php 
include('header.php'); 
include('sidebar.php'); 
include('database.php');

$id = $merchandise_id = $user_id = $merchandise_name = $user_name = $date = $qty = $comments = $payment_type = $discount = $referrer = $status = "";
$edit_mode = false;

// If editing, get order details
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $merchandise_id = $row['merchandise_id'];
        $user_id = $row['user_id'];
        $date = $row['date'];
        $qty = $row['qty'];
        $comments = $row['comments'];
        $payment_type = $row['payment_type'];
        $discount = $row['discount'];
        $referrer = $row['referrer'];
        $status = $row['status'];
        $edit_mode = true;
    }
    $stmt->close();

    // Fetch merchandise name
    $merchandiseStmt = $conn->prepare("SELECT name FROM merchandise WHERE id = ?");
    $merchandiseStmt->bind_param("i", $merchandise_id);
    $merchandiseStmt->execute();
    $merchandiseResult = $merchandiseStmt->get_result();
    if($merchandiseResult->num_rows > 0) {
        $merchandiseRow = $merchandiseResult->fetch_assoc();
        $merchandise_name = $merchandiseRow['name'];
    }
    $merchandiseStmt->close();

    // Fetch user name
    $userStmt = $conn->prepare("SELECT firstname FROM users WHERE id = ?");
    $userStmt->bind_param("i", $user_id);
    $userStmt->execute();
    $userResult = $userStmt->get_result();
    if($userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();
        $user_name = $userRow['firstname'];
    }
    $userStmt->close();
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css">
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <style>
        .content-wrapper {
            margin-left: 250px; /* Adjust based on sidebar width */
        }
    </style>
</head>

<body>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <?php include('header.php'); ?>
        <?php include('sidebar.php'); ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1><?php echo $edit_mode ? 'Edit' : 'Add'; ?> Orders</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Orders</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title"><?php echo $edit_mode ? 'Edit' : 'Add'; ?> Orders</h3>
                                </div>
                                <form method="post" action="update_orders.php" class="form-horizontal">
                                    <div class="card-body">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>">
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="merchandise_id" class="col-sm-2 col-form-label">Merchandise</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2bs4" style="width: 100%;" id="merchandise_id" name="merchandise_id" required>
                                                    <option value="">-- Select Merchandise --</option>
                                                    <?php 
                                                    $merchandiseQuery = "SELECT id, name FROM merchandise";
                                                    $merchandiseResult = $conn->query($merchandiseQuery);
                                                    if ($merchandiseResult->num_rows > 0) {
                                                        while($merchandise = $merchandiseResult->fetch_assoc()){ ?>
                                                            <option value="<?php echo $merchandise['id']; ?>" <?php echo ($merchandise['id'] == $merchandise_id) ? 'selected="selected"' : ''; ?>>
                                                                <?php echo htmlspecialchars($merchandise['name'], ENT_QUOTES, 'UTF-8'); ?>
                                                            </option>
                                                        <?php } 
                                                    } else {
                                                        echo '<option value="">No merchandise found</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="user_id" class="col-sm-2 col-form-label">User</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2bs4" style="width: 100%;" id="user_id" name="user_id" required>
                                                    <option value="">-- Select Users --</option>
                                                    <?php 
                                                    $userQuery = "SELECT id, firstname FROM users";
                                                    $userResult = $conn->query($userQuery);
                                                    if ($userResult->num_rows > 0) {
                                                        while($user = $userResult->fetch_assoc()){ ?>
                                                            <option value="<?php echo $user['id']; ?>" <?php echo ($user['id'] == $user_id) ? 'selected="selected"' : ''; ?>>
                                                                <?php echo htmlspecialchars($user['firstname'], ENT_QUOTES, 'UTF-8'); ?>
                                                            </option>
                                                        <?php } 
                                                    } else {
                                                        echo '<option value="">No users found</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="date" class="col-sm-2 col-form-label">Date</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" id="date" name="date" placeholder="Date" value="<?php echo htmlspecialchars($date, ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="qty" class="col-sm-2 col-form-label">Quantity</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="qty" name="qty" placeholder="Quantity" value="<?php echo htmlspecialchars($qty, ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="comments" class="col-sm-2 col-form-label">Comments</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="comments" name="comments" placeholder="Comments" value="<?php echo htmlspecialchars($comments, ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="payment_type" class="col-sm-2 col-form-label">Payment Type</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="payment_type" name="payment_type" placeholder="Payment Type" value="<?php echo htmlspecialchars($payment_type, ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="discount" class="col-sm-2 col-form-label">Discount</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" value="<?php echo htmlspecialchars($discount, ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="referrer" class="col-sm-2 col-form-label">Referrer</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="referrer" name="referrer" placeholder="Referrer" value="<?php echo htmlspecialchars($referrer, ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="status" name="status" placeholder="Status" value="<?php echo htmlspecialchars($status, ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-info"><?php echo $edit_mode ? 'Update' : 'Save'; ?></button>
                                        <a href="orders.php" class="btn btn-default float-right">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php include('footer.php'); ?>
        <?php $conn->close(); ?>
    </div>

    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/app-style-switcher.js"></script>
    <script src="../dist/js/feather.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <script src="../dist/js/custom.min.js"></script>
    <script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    <script src="../dist/js/pages/datatable/datatable-basic.init.js"></script>
</body>

</html>
