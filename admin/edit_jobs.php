<?php 
include('header.php'); 
include('sidebar.php'); 
include('database.php');

$id = $title = $description = $companyid = $location = $type = $requirements = $date = "";
$edit_mode = false;

// If editing, get job details
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM job WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $description = $row['description'];
        $companyid = $row['companyid'];
        $location = $row['location'];
        $type = $row['type'];
        $requirements = $row['requirements'];
        $date = $row['date'];
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
                            <h1><?php echo $edit_mode ? 'Edit' : 'Add'; ?> Jobs</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Jobs</li>
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
                                    <h3 class="card-title"><?php echo $edit_mode ? 'Edit' : 'Add'; ?> Jobs</h3>
                                </div>
                                <form method="post" action="update_jobs.php" class="form-horizontal">
                                    <div class="card-body">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="companyid" class="col-sm-2 col-form-label">Company</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2bs4" style="width: 100%;" id="companyid" name="companyid">
                                                    <option value="0">-- Select Company --</option>
                                                    <?php 
                                                    $companyQuery = "SELECT id, name FROM company";
                                                    $companyResult = $conn->query($companyQuery);
                                                    if ($companyResult->num_rows > 0) {
                                                        while($company = $companyResult->fetch_assoc()){ ?>
                                                            <option value="<?php echo $company['id']; ?>" <?php echo ($company['id'] == $companyid) ? 'selected="selected"' : ''; ?>>
                                                                <?php echo htmlspecialchars($company['name'], ENT_QUOTES, 'UTF-8'); ?>
                                                            </option>
                                                        <?php } 
                                                    } else {
                                                        echo '<option value="">No companies found</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="location" class="col-sm-2 col-form-label">Location</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="<?php echo htmlspecialchars($location, ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="type" class="col-sm-2 col-form-label">Job Type</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="type" name="type" placeholder="Job Type" value="<?php echo htmlspecialchars($type, ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="requirements" class="col-sm-2 col-form-label">Requirements</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="requirements" name="requirements" placeholder="Requirements" value="<?php echo htmlspecialchars($requirements, ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="date" class="col-sm-2 col-form-label">Date</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" id="date" name="date" placeholder="Date" value="<?php echo htmlspecialchars($date, ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-info"><?php echo $edit_mode ? 'Update' : 'Save'; ?></button>
                                        <a href="jobs.php" class="btn btn-default float-right">Cancel</a>
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
