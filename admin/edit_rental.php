<?php 
include('header.php'); 
include('sidebar.php'); 
include('database.php');

$id = $studio_id = $equipment_id = $user_id = $date = $return_date = $cost = "";
$edit_mode = false;

// If editing, get user details
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM rental WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $studio_id = $row['studio_id'];
        $equipment_id = $row['equipment_id'];
        $user_id = $row['user_id'];
        $date = $row['date'];
        $return_date = $row['return_date'];
        $cost = $row['cost'];
        $edit_mode = true;
    }
}

// Fetch studios
$studios = mysqli_query($conn, "SELECT id, name FROM studio");

// Fetch equipment
$equipments = mysqli_query($conn, "SELECT id, name FROM equipment");

// Fetch users
$users = mysqli_query($conn, "SELECT id, firstname FROM users");
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
                            <h1><?php echo $edit_mode ? 'Edit' : 'Add'; ?> Rental Equipments</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Rental Equipments</li>
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
                                    <h3 class="card-title"><?php echo $edit_mode ? 'Edit' : 'Add'; ?> Rental Equipments</h3>
                                </div>
                                <form method="post" action="update_rental.php" class="form-horizontal">
                                    <div class="card-body">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="studio_id" class="col-sm-2 col-form-label">Studio</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="studio_id" name="studio_id" required>
                                                    <option value="">--Select Studio--</option>
                                                    <?php while ($studio = mysqli_fetch_assoc($studios)): ?>
                                                        <option value="<?php echo $studio['id']; ?>" <?php echo ($studio['id'] == $studio_id) ? 'selected' : ''; ?>>
                                                            <?php echo $studio['name']; ?>
                                                        </option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="equipment_id" class="col-sm-2 col-form-label">Equipment</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="equipment_id" name="equipment_id" required>
                                                    <option value="">--Select Equipment--</option>
                                                    <?php while ($equipment = mysqli_fetch_assoc($equipments)): ?>
                                                        <option value="<?php echo $equipment['id']; ?>" <?php echo ($equipment['id'] == $equipment_id) ? 'selected' : ''; ?>>
                                                            <?php echo $equipment['name']; ?>
                                                        </option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="user_id" class="col-sm-2 col-form-label">Users</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2bs4" style="width: 100%;" id="user_id" name="user_id">
                                                    <option value="0">-- Select Users --</option>
                                                    <?php while ($user = mysqli_fetch_assoc($users)): ?>
                                                        <option value="<?php echo $user['id']; ?>" <?php echo ($user['id'] == $user_id) ? 'selected="selected"' : ''; ?>>
                                                            <?php echo htmlspecialchars($user['firstname'], ENT_QUOTES, 'UTF-8'); ?>
                                                        </option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="date" class="col-sm-2 col-form-label">Rental Date</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" id="date" name="date" placeholder="date" value="<?php echo $date; ?>" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row"style="margin-bottom: 20px">
                                            <label for="return_date" class="col-sm-2 col-form-label">Return Date</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" id="return_date" name="return_date" placeholder="return_date" value="<?php echo $return_date; ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="cost" class="col-sm-2 col-form-label">Total Cost</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="cost" name="cost" placeholder="Cost" value="<?php echo $cost; ?>" required>
                                            </div>
                                        </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-info"><?php echo $edit_mode ? 'Update' : 'Save'; ?></button>
                                        <a href="users.php" class="btn btn-default float-right">Cancel</a>
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
