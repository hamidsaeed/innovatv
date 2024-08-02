<?php include('header.php');
$sqli = "select * from area";
$iarr = $conn->query($sqli);
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM staff WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
       // print_r($row);
       // exit;
?>
<?php
    }
} 
?>
<?php include('sidebar.php'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Staff</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Staff</li>
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
                            <h3 class="card-title">Staff</h3>
                        </div>
                        <form method="post" action="update_staff.php" class="form-horizontal">
                        <input type="hidden" id="id" name="id" value="<?php echo isset($row['id']) ? $row['id'] : ''; ?>">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name"value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?php echo isset($row['phone']) ? $row['phone'] : ''; ?>">
                                    </div>
                                </div>
                     
                                <div class="form-group row">
                                    <label for="location_id" class="col-sm-2 col-form-label">Location</label>
                                     <div class="col-sm-10">
                                     <div class="form-group">
                                    <select class="form-control select2bs4" style="width: 100%;" id="location_id" name="location_id">
                                    <option value="0">-- Select --</option>
                                    <?php while($area = $iarr->fetch_assoc()){ 
                                       // print_r($area);
                                       // exit;?>
                                        <option value="<?php echo isset($area['id']) ? $area['id'] : ''; ?>" <?php echo (isset($row['location_id']) && $area['id']==$row['location_id']) ? 'selected="selected"' : ''; ?>>
                                            <?php echo isset($area['name']) ? $area['name'] : ''; ?>
                                            </option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>">
                                    </div>
                                </div>
                       
                                 <div class="form-group row">
                                <label for="" class="col-form-label">Date of Joining</label>
                                  <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate1" id="date_of_joining" name="date_of_joining" value="<?php echo isset($row['date_of_joining']) ? $row['date_of_joining'] : ''; ?>" placeholder="<?php echo isset($row['date_of_joining']) ? $row['date_of_joining'] : ''; ?>" />
                                    <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                              </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="status" name="status">
                                            <option value="1" <?php echo (isset($row['status']) && $row['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                                            <option value="0" <?php echo (isset($row['status']) && $row['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <div class="form-check">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" value="Save" class="btn-info">Save</button>
                                <button type="submit" class="btn btn-default float-right">Cancel</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<aside class="control-sidebar control-sidebar-dark">
</aside>
<?php include('footer.php'); ?>
