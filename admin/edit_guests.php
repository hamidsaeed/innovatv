
<?php 
include('database.php');
include('header.php');
include('sidebar.php');


$id = $user_id  = $bio = $availability  = $expertise = "";
$edit_mode = false;

// If editing, get user details
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM guest WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['user_id'];
        $bio = $row['bio'];
        $availability = $row['availability'];
        $expertise = $row['expertise'];
        $edit_mode = true;
    }
}

$users = mysqli_query($conn, "SELECT id, firstname FROM users");

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
                            <h1><?php echo $edit_mode ? 'Edit' : 'Add'; ?> Guests</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Guests</li>
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
                                    <h3 class="card-name"><?php echo $edit_mode ? 'Edit' : 'Add'; ?> Guests</h3>
                                </div>
                                <form method="post" action="update_guests.php" class="form-horizontal">
                                    <div class="card-body">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="user_id" class="col-sm-2 col-form-label">Users</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2bs4" style="width: 100%;" id="user_id" name="user_id">
                                                    <option value="0">-- Select Users--</option>
                                                    <?php while ($user = mysqli_fetch_assoc($users)): ?>
                                                        <option value="<?php echo $user['id']; ?>" <?php echo ($user['id'] == $user_id) ? 'selected="selected"' : ''; ?>>
                                                            <?php echo htmlspecialchars($user['firstname'], ENT_QUOTES, 'UTF-8'); ?>
                                                        </option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="bio" class="col-sm-2 col-form-label">Biography</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="bio" name="bio" placeholder="Biography" value="<?php echo $bio; ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="availability" class="col-sm-2 col-form-label">Availability</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="availability" name="availability" placeholder="Availability" value="<?php echo $availability; ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="expertise" class="col-sm-2 col-form-label">Expertise</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="expertise" name="expertise" placeholder="expertise" value="<?php echo $expertise; ?>" required>
                                            </div>
                                        </div>



                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-info"><?php echo $edit_mode ? 'Update' : 'Save'; ?></button>
                                        <a href="guests.php" class="btn btn-default float-right">Cancel</a>
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
