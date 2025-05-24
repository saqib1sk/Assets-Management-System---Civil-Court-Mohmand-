<?php
require_once('session_data.php');
require_once('my_connection.php');
?>
<!DOCTYPE html>
<html>
<?php require_once('my_meta.php'); ?>


    <body>


        <!-- Navigation Bar-->
        <head>
        
         
         <?php require_once('my_header.php'); ?>
        
        <link href="assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
           <!-- DataTables link files -->
         <?php require_once('datatable_link_files.php'); ?>
          <!-- DataTables link files end -->
        <script src="dist/jquery.js"></script>
        </head>
        <div class="wrapper">
            <div class="container">
                <br>
             <div class="row">
                <div class="col-12">
                    <div class="col-md-10"><h3>System Backup</h3></div>
                    <div class="col-md-2"><a href="db_export.php" class="btn btn-primary" style="float:right;"><b><i class="fas fa-database"></i>&nbsp;Take Backup</b></a></div>
                </div>
             </div>
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="card-box table-responsive">                       
                            <table id="datatable" class="table table-striped table-bordered" data-page-length="25">
                            <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Date (D-M-Y)</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
            <?php
              $serial = 0;
              $backup = "SELECT * FROM backup";
              $run_backup = mysqli_query($my_connection,$backup);
              while ($row_backup = mysqli_fetch_array($run_backup)) 
              {
                $serial++;
                $dbName = $row_backup['name'];
                $dbId = $row_backup['id'];
                $dbDate = date("d-m-Y", strtotime($row_backup['date']));
              ?>
              <tr>
                <td><?php echo $serial ?></td>
                <td><a href="dbBackup/<?php echo $dbName ?>"> <?php echo $dbName ?>  -  <button class="btn btn-success"><i class="fas fa-download"></i>&nbsp;Download</button></a></td>
                <td><?php echo $dbDate ?></td>
                <td>
                  <a href="db_import.php?db_Name=<?php echo $dbName ?>" onclick="return confirm('Are you sure want to Import, This will Replace the existing one')">Import</a> ||
                  <a href="backup.php?dbname=<?php echo $dbName ?>" onclick="return confirm('Are you sure you want to delete, This action cannot undo !')">Delete</a>
                  
                </td>
              </tr>
            <?php } ?>
          </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <?php require_once('my_footer.php'); ?>
                <!-- End Footer -->
            </div> <!-- end container -->
        </div> <!-- end wrapper -->
        <!-- jQuery  -->
       <?php require_once('jq_files.php'); ?>
        <!--End jQuery  -->
         <!-- datatable_script_files -->
<?php require_once('datatable_script_files.php'); ?>
                <!-- End datatable_script_files --> 
    </body>
</html>
<?php
if(isset($_GET['dbname']))
{
  $dbName = $_GET['dbname'];
  $delete_backup = "DELETE FROM backup WHERE name = '$dbName'";
  $run_DelBackup = mysqli_query($my_connection,$delete_backup);
  echo $file_to_delete = "dbBackup/$dbName";
  unlink($file_to_delete);
  echo "<script>window.location.href = 'backup.php'</script>";
}
?>