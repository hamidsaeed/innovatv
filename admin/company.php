<?php
include('header.php');
include('sidebar.php');
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
</head>

<body>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <?php include('header.php'); ?>
        <?php include('sidebar.php'); ?>

        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title">Company</h4>
                                    <a href="edit_company.php" class="btn btn-success">Add New</a>
                                </div>
                                <div class="table-responsive">
                                    <?php
                                    $sql= "SELECT * FROM company";
                                    $result = mysqli_query($conn, $sql); 
                                    ?>
                                    <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Industry</th>
                                                <th>Location</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($result){
                                                if(mysqli_num_rows($result) > 0){
                                                    while($row = mysqli_fetch_assoc($result)){
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $row['id']; ?></td>
                                                            <td><?php echo $row['name']; ?></td>
                                                            <td><?php echo $row['description']; ?></td>
                                                            <td><?php echo $row['industry']; ?></td>
                                                            <td><?php echo $row['location']; ?></td>
                                                            <td>
                                                                <a href="edit_company.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                                                                <a href="delete.php?id=<?php echo $row['id']; ?>&table=company&tableid=id" class="btn btn-danger">Delete</a>
                                                                </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            }?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>ID</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Industry</th>
                                                <th>Location</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
