<?php 
include('header.php'); 
include('sidebar.php'); 
include('database.php');

$id = $job_id = $user_id = $date = $status = "";
$edit_mode = false;

// If editing, get user details
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM applications WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $job_id = $row['job_id'];
        $user_id = $row['user_id'];
        $date = $row['date'];
        $status = $row['status'];
        $edit_mode = true;
    }
    $stmt->close();
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
                            <h1><?php echo $edit_mode ? 'Edit' : 'Add'; ?> Clients</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Clients</li>
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
                                    <h3 class="card-title"><?php echo $edit_mode ? 'Edit' : 'Add'; ?> Clients</h3>
                                </div>
                                <form method="post" action="update_application.php" class="form-horizontal">
                                    <div class="card-body">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <div class="form-group row" style="margin-bottom: 20px;">
                                            <label for="job_id" class="col-sm-2 col-form-label">Job Title</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2bs4" style="width: 100%;" id="job_id" name="job_id" required>
                                                    <option value="0">-- Select Jobs--</option>
                                                    <?php 
                                                    $jobQuery = "SELECT id, title FROM job";
                                                    $jobResult = $conn->query($jobQuery);
                                                    if ($jobResult->num_rows > 0) {
                                                        while($job = $jobResult->fetch_assoc()){ ?>
                                                            <option value="<?php echo htmlspecialchars($job['id'], ENT_QUOTES, 'UTF-8'); ?>" <?php echo ($job['id'] == $job_id) ? 'selected="selected"' : ''; ?>>
                                                                <?php echo htmlspecialchars($job['title'], ENT_QUOTES, 'UTF-8'); ?>
                                                            </option>
                                                        <?php } 
                                                    } else {
                                                        echo '<option value="">No jobs found</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row" style="margin-bottom: 20px;">
                                            <label for="user_id" class="col-sm-2 col-form-label">User</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2bs4" style="width: 100%;" id="user_id" name="user_id" required>
                                                    <option value="0">-- Select Users --</option>
                                                    <?php 
                                                    $userQuery = "SELECT id, firstname FROM users";
                                                    $userResult = $conn->query($userQuery);
                                                    if ($userResult->num_rows > 0) {
                                                        while($user = $userResult->fetch_assoc()){ ?>
                                                            <option value="<?php echo htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?>" <?php echo ($user['id'] == $user_id) ? 'selected="selected"' : ''; ?>>
                                                                <?php echo htmlspecialchars($user['firstname'], ENT_QUOTES, 'UTF-8'); ?>
                                                            </option>
                                                        <?php } 
                                                    } else {
                                                        echo '<option value="">No users found</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row" style="margin-bottom: 20px;">
                                            <label for="date" class="col-sm-2 col-form-label">Date</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" id="date" name="date" placeholder="Date" value="<?php echo htmlspecialchars($date, ENT_QUOTES, 'UTF-8'); ?>" required>
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
                                        <a href="applications.php" class="btn btn-default float-right">Cancel</a>
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
