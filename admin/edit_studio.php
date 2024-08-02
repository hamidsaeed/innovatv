
<?php 
include('header.php'); 
include('sidebar.php'); 
include('database.php');

$id = $name = $user_id = $rate = $location = $description = $status = "";
$edit_mode = false;

// If editing, get user details
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM studio WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $user_id = $row['user_id'];
        $rate = $row['rate'];
        $location = $row['location'];
        $description =$row['description'];
        $edit_mode = true;
    }
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="user_id" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <name>Admin Panel</name>
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
                            <h1><?php echo $edit_mode ? 'Edit' : 'Add'; ?> Studio</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Studio</li>
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
                                    <h3 class="card-name"><?php echo $edit_mode ? 'Edit' : 'Add'; ?> Studio</h3>
                                </div>
                                <form method="post" action="update_studio.php" class="form-horizontal">
                                    <div class="card-body">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $name; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="user_id" class="col-sm-2 col-form-label">Users</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2bs4" style="width: 100%;" id="user_id" name="user_id">
                                                    <option value="0">-- Select --</option>
                                                    <?php 
                                                    $userQuery = "SELECT id, firstname FROM users";
                                                    $userResult = $conn->query($userQuery);
                                                    if ($userResult->num_rows > 0) {
                                                        while($users = $userResult->fetch_assoc()){ ?>
                                                            <option value="<?php echo $users['id']; ?>" <?php echo ($users['id'] == $user_id) ? 'selected="selected"' : ''; ?>>
                                                                <?php echo htmlspecialchars($users['firstname'], ENT_QUOTES, 'UTF-8'); ?>
                                                            </option>
                                                        <?php } 
                                                    } else {
                                                        echo '<option value="">No users found</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="rate" class="col-sm-2 col-form-label">Base Rate</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="rate" name="rate" placeholder="Base Rate" value="<?php echo $rate; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="location" class="col-sm-2 col-form-label">Location</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="<?php echo $location; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description; ?>" required>
                                            </div>
                                        </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-info"><?php echo $edit_mode ? 'Update' : 'Save'; ?></button>
                                        <a href="project.php" class="btn btn-default float-right">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php include('footer.php'); ?>
        <?php mysqli_close($conn); ?>
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
