<?php 
include('database.php');
include('header.php');
include('sidebar.php');


$id = $channel = $title = $description= $host_id= $guest_id= $release_date = "";
$edit_mode = false;

// If editing, get user details
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM episode WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $channel = $row['channel'];
        $title = $row['title'];
        $description = $row['description'];
        $host_id = $row['host_id'];
        $guest_id = $row['guest_id'];
        $release_date = $row['release_date'];
        $edit_mode = true;
    }
}

// Fetch users for dropdowns
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
                            <h1><?php echo $edit_mode ? 'Edit' : 'Add'; ?> Episodes</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Episodes</li>
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
                                    <h3 class="card-name"><?php echo $edit_mode ? 'Edit' : 'Add'; ?> Episodes</h3>
                                </div>
                                <form method="post" action="update_episode.php" class="form-horizontal">
                                    <div class="card-body">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="channel" class="col-sm-2 col-form-label">Channel</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="channel" name="channel" placeholder="Channel" value="<?php echo $channel; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?php echo $title; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="host_id" class="col-sm-2 col-form-label">Host</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2bs4" style="width: 100%;" id="host_id" name="host_id">
                                                    <option value="0">-- Select Hosts--</option>
                                                    <?php 
                                                    if ($users->num_rows > 0) {
                                                        $users->data_seek(0); // Reset the pointer to the start of the result set
                                                        while($user = $users->fetch_assoc()) { ?>
                                                            <option value="<?php echo $user['id']; ?>" <?php echo ($user['id'] == $host_id) ? 'selected="selected"' : ''; ?>>
                                                                <?php echo htmlspecialchars($user['firstname'], ENT_QUOTES, 'UTF-8'); ?>
                                                            </option>
                                                        <?php }
                                                    } else {
                                                        echo '<option value="">No hosts found</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="guest_id" class="col-sm-2 col-form-label">Guest</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2bs4" style="width: 100%;" id="guest_id" name="guest_id">
                                                    <option value="0">-- Select Guests--</option>
                                                    <?php 
                                                    if ($users->num_rows > 0) {
                                                        $users->data_seek(0); // Reset the pointer to the start of the result set
                                                        while($user = $users->fetch_assoc()) { ?>
                                                            <option value="<?php echo $user['id']; ?>" <?php echo ($user['id'] == $guest_id) ? 'selected="selected"' : ''; ?>>
                                                                <?php echo htmlspecialchars($user['firstname'], ENT_QUOTES, 'UTF-8'); ?>
                                                            </option>
                                                        <?php }
                                                    } else {
                                                        echo '<option value="">No guests found</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="release_date" class="col-sm-2 col-form-label">Release Date</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" id="release_date" name="release_date" placeholder="Release Date" value="<?php echo $release_date; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-info"><?php echo $edit_mode ? 'Update' : 'Save'; ?></button>
                                        <a href="episode.php" class="btn btn-default float-right">Cancel</a>
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
