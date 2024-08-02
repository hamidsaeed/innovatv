<?php
include('header.php');
include('sidebar.php');
include('database.php');

$sql = "SELECT e.id, e.channel, e.title, e.description, u1.firstname as host_name, u2.firstname as guest_name, e.release_date 
        FROM episode e
        LEFT JOIN users u1 ON e.host_id = u1.id
        LEFT JOIN users u2 ON e.guest_id = u2.id";
$result = mysqli_query($conn, $sql);
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
                            <h1>Episodes</h1>
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
                                    <h3 class="card-title">Episodes</h3>
                                </div>
                                <div class="card-body">
                                    <table id="episodes" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            <th>ID</th>
                                                <th>Channel</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Host</th>
                                                <th>Guest</th>
                                                <th>Release Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if($result){
                                                if(mysqli_num_rows($result) > 0){
                                                    while($row = mysqli_fetch_assoc($result)){
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $row['id']; ?></td>
                                                            <td><?php echo $row['channel']; ?></td>
                                                            <td><?php echo $row['title']; ?></td>
                                                            <td><?php echo $row['description']; ?></td>
                                                            <td><?php echo $row['host_name']; ?></td>
                                                            <td><?php echo $row['guest_name']; ?></td>
                                                            <td><?php echo $row['release_date']; ?></td>
                                                            <td>
                                                                <a href="edit_episode.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                                                                <a href="delete.php?id=<?php echo $row['id']; ?>&table=episode&tableid=id" class="btn btn-danger">Delete</a>
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
                                                <th>Channel</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Host</th>
                                                <th>Guest</th>
                                                <th>Release Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>

                                    </table>
                                </div>
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
