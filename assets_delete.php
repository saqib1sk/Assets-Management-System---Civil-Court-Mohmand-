<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Delete</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>

</head>
<body>
      
</body>
</html>
<?php
 require_once('my_connection.php');
 
  if(isset($_GET['id']) && isset($_GET['available_asset_id']) && isset($_GET['issue_qty'])){
        $id = $_GET['id'];
        $available_asset_id=$_GET['available_asset_id'];
        $issue_qty=$_GET['issue_qty'];

$select_qry="SELECT aa.quantity AS asset_available_quantity, iad.quantity_issue
FROM issue_assets ia
JOIN issue_asset_details iad ON ia.id = iad.issue_asset_id
JOIN asset_available aa ON iad.available_asset_id = aa.id
WHERE ia.id = '$id' AND aa.id='$available_asset_id'";


   /*   $select_qry="SELECT asset_available.quantity, issue_asset_details.quantity_issue FROM asset_available
        JOIN asset_items ON asset_items.id = asset_available.asset_item_id
        JOIN issue_assets ON issue_assets.id = issue_asset_details.issue_asset_id
        JOIN issue_asset_details ON issue_asset_details.issue_asset_id = issue_assets.id
        WHERE asset_available.id='$id'"; */

        $run_select_qry = mysqli_query($my_connection,$select_qry);
        while($rowData=mysqli_fetch_assoc($run_select_qry)){

            $row_quantity = $rowData['asset_available_quantity'];
            $row_issue_quantity = $rowData['quantity_issue'];

        }



        $issue_asset_detail_delete = "DELETE FROM `issue_asset_details` WHERE `available_asset_id` = '$available_asset_id' AND `quantity_issue`='$issue_qty'";
        $run_issue_asset_detail_delete = mysqli_query($my_connection,$issue_asset_detail_delete);

        if($run_issue_asset_detail_delete){

          $check_entries_query = "SELECT count(id) AS c_id FROM issue_asset_details WHERE issue_asset_id='$id'";
          $run_check_entries_query = mysqli_query($my_connection,$check_entries_query);

          $check_entries_queryData = mysqli_fetch_array($run_check_entries_query);
          $check_val = $check_entries_queryData['c_id'];

          if($check_val>0){

            $new_quantity = $row_quantity + $row_issue_quantity;
            $asset_available_update = "UPDATE `asset_available` SET `quantity`='$new_quantity' WHERE `id`='$available_asset_id'";
            $run_asset_available_update = mysqli_query($my_connection,$asset_available_update);
             
            if($run_asset_available_update){
                  echo '<script>
                  Swal.fire({
                    icon: "success",
                    title: "Deleted",
                    text: "Stock Deleted Successfully."
                  }).then((result) => {
                    if (result.isConfirmed || result.isDismissed) {
                      window.location.href = "issue_assets.php";
                    }
                  });
                  </script>'; 
            }else{
                  echo '<script>
                  Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!"
                  }).then((result) => {
                    if (result.isConfirmed || result.isDismissed) {
                      window.location.href = "issue_assets.php";
                    }
                  });
                  </script>';  
            }
           
          }else{
            $issue_asset_delete = "DELETE FROM issue_assets WHERE id='$id'";
            $run_issue_asset_delete = mysqli_query($my_connection,$issue_asset_delete);

            $new_quantity = $row_quantity + $row_issue_quantity;
            $asset_available_update = "UPDATE `asset_available` SET `quantity`='$new_quantity' WHERE `id`='$available_asset_id'";
            $run_asset_available_update = mysqli_query($my_connection,$asset_available_update);
            
            if($run_asset_available_update){
              echo '<script>
              Swal.fire({
                icon: "success",
                title: "Deleted",
                text: "Stock Deleted Successfully."
              }).then((result) => {
                if (result.isConfirmed || result.isDismissed) {
                  window.location.href = "issue_assets.php";
                }
              });
              </script>'; 
        }else{
              echo '<script>
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!"
              }).then((result) => {
                if (result.isConfirmed || result.isDismissed) {
                  window.location.href = "issue_assets.php";
                }
              });
              </script>';  
        }
            
          }




            
}
  }

                                                                               
?>