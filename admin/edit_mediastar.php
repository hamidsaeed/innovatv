
<?php 
include('database.php');
include('header.php');
include('sidebar.php');


$id = $name =  $bio = $socialmedialinks ="";
$edit_mode = false;

// If editing, get user details
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM mediastar WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $bio = $row['bio'];
        $socialmedialinks = $row['socialmedialinks'];
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
                            <h1><?php echo $edit_mode ? 'Edit' : 'Add'; ?> Mediastars</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Media Stars</li>
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
                                    <h3 class="card-name"><?php echo $edit_mode ? 'Edit' : 'Add'; ?> Media Stars</h3>
                                </div>
                                <form method="post" action="update_mediastar.php" class="form-horizontal">
                                    <div class="card-body">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="name" class="col-sm-2 col-form-label">Media Star</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?php echo $name; ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="bio" class="col-sm-2 col-form-label">Biography</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="bio" name="bio" placeholder="Biography" value="<?php echo $bio; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="socialmedialinks" class="col-sm-2 col-form-label">Social Media</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="socialmedialinks" name="socialmedialinks" placeholder="socialmedialinks" value="<?php echo $socialmedialinks; ?>" required>
                                            </div>
                                        </div>



                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-info"><?php echo $edit_mode ? 'Update' : 'Save'; ?></button>
                                        <a href="mediastar.php" class="btn btn-default float-right">Cancel</a>
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
