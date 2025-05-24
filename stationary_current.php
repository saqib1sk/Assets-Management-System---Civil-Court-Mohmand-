<?php
require_once('session_data.php');
require_once('my_connection.php');
?>
  
<!DOCTYPE html>
<html>
 <title>Assets Managment System</title>
<?php require_once('my_meta.php'); ?>
    <body>
        <head>
         <?php require_once('my_header.php'); ?>
        <link href="assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>
        </head>
        <div class="wrapper">
            <div class="container">
            
            
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Stationary List</h4>
                        <ol class="breadcrumb">
                        </ol>
                    </div>
                </div>
                
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title"><b>Current Stationary List</b></h4>
                            

                            <!-- <table id="datatable-buttons" class="table table-striped table-bordered"> -->
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Serial #</th>
                                    
                                    
                                    <th>Supplier</th>
                                    <th>Category</th>
                                    <th>PO No</th>
                                    <th>Item Name</th>
                                    <th>Item No</th>
                                    <th>Unit</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Total Amount</th>
                                     <th>Discription</th>
                                     <th>File</th>
                                  <!-- <th>Actions</th> -->
                                </tr>
                                </thead>


                                <tbody>
                 <?php 

                   $today = date("Y-m-d");
              
 $select_qry2 = mysqli_query($my_connection, "select a.*,s.name,c.title as category_name,i.unit,i.item_name,aa.quantity as current_quantity from assets a 
                                              join suppliers s on a.supplier_id = s.id
                                              join categories c on a.category_id = c.id
                                              join items i on a.item_id = i.id 
                                              join asset_available aa on aa.category_id = a.category_id
                                              where a.category_id = 1 
                                              and aa.category_id = 1") or die(mysqli_error($my_connection));
                                $n = 1;
                                  while($row2 = mysqli_fetch_array($select_qry2)){
                                  $id = $row2['id'];

                           
                             echo ' <tr role="row" class="odd">';
                                    
                                    echo '<td> '.$n++.'</td>';

                                    echo  '<td class="">';
                                    echo '<b>'.$row2['name'].'</b>';
                                    echo '</td>';

                                    echo  '<td class="">';
                                    echo '<b>'.$row2['category_name'].'</b>';
                                    echo '</td>';
                                        
                                    echo  '<td class="">';
                                    echo '<b>'.$row2['po_no'].'</b>';
                                    echo '</td>';
                                           echo  '<td class="">';
                                          echo '<b>'.$row2['item_name'].'</b>';
                                          echo '</td>';

                                          echo  '<td class="">';
                                          echo $row2['item_no'];
                                          echo '</td>';

                                           echo  '<td class="">';
                                          echo $row2['unit'];
                                          echo '</td>';

                                           echo  '<td class="">';
                                           echo $row2['price'];
                                          echo '</td>';

                                           echo  '<td class="">';
                                          echo $row2['current_quantity'];
                                          echo '</td>';
                                          
                                            echo  '<td class="">';
                                          echo $row2['total_amount'];
                                          echo '</td>';

                                          echo  '<td class="">';
                                          echo $row2['description'];
                                          echo '</td>';


                                          echo  '<td class="">';
                                         
            echo ' <div class="media-left">
            <a href="#"> <img class="media-object img-circle" alt="Image Not yet Added" src="'.$row2['file_path'].'" style="width: 74px; height: 74px;"> </a>
        </div>';
  
                                            echo '</td>'; 

                                          
                            //            echo '<td style="width:90px;">';
                               
                            //        echo ' <a href="#" >
                                   
                                        
                            //  <a  href ="assets_edit.php?id='.$id.'" data-toggle="tooltip" data-placement="bottom" title="Edit" style=""> 
                            //     <i class="ti-pencil" style="font-size:25px; color:success; margin-top:10px; margin-left:0px;"></i>
                            //      </a>
                
                            //      ';
                            //                 echo '</td>';
                                     echo '</tr>';

                          
                            }
                   ?> 
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <?php require_once('my_footer.php'); ?>
                <!-- End Footer -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

  <script src="assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
        <script src="assets/pages/jquery.sweet-alert.init.js"></script>
   
         <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="assets/plugins/datatables/jszip.min.js"></script>
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.scroller.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.colVis.js"></script>
        <script src="assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>
        <script src="assets/pages/datatables.init.js"></script>
        <!-- App core js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable({keys: true});
                $('#datatable-responsive').DataTable();
                $('#datatable-colvid').DataTable({
                    "dom": 'C<"clear">lfrtip',
                    "colVis": {
                        "buttonText": "Change columns"
                    }
                });
                $('#datatable-scroller').DataTable({
                    ajax: "assets/plugins/datatables/json/scroller-demo.json",
                    deferRender: true,
                    scrollY: 380,
                    scrollCollapse: true,
                    scroller: true
                });
                var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
                var table = $('#datatable-fixed-col').DataTable({
                    scrollY: "300px",
                    scrollX: true,
                    scrollCollapse: true,
                    paging: false,
                    fixedColumns: {
                        leftColumns: 1,
                        rightColumns: 1
                    }
                });
            });
            TableManageButtons.init();
        </script>
    </body>
</html>