<?php
require_once('session_data.php');
$user_id = $_SESSION['user_id'];
$role_id = @$_SESSION['role_id'];
require_once('my_connection.php');
 
?>

<?php
// $select_qry = mysqli_query($my_connection, "select id,image_path  from users  
// where id = '$user_id'") or die(mysqli_error($my_connection));
//                                   while($row = mysqli_fetch_array($select_qry)){
//                                  $image_path = $row['image_path'];
//                                     }
?>

<header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- Logo container-->
                    <div class="logo">
              <a href="index.php" class="logo"><span>Assets Management <smal style="color: #2eca6a;">System</small></span></a>
                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras">

                        <ul class="nav navbar-nav navbar-right pull-right">
                 
                        

                            <li class="dropdown navbar-c-items">
                                <a href="#" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><img src="assets/images/child.jpg" alt="user-img" class="img-circle"> </a>
                                <ul class="dropdown-menu">
                                  
                                    <li><a href="logout.php"><i class="ti-power-off text-danger m-r-10"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="menu-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </div>
                    </div>

                </div>
            </div>
<?php  if ($role_id == 1){
 

 echo '<div class="navbar-custom">
 <div class="container">
     <div id="navigation">
         <!-- Navigation Menu-->
         <ul class="navigation-menu">
             <li class="has-submenu">
                 <a href="index.php"><i class="md md-dashboard"></i>Dashboard</a>
            
             </li>
             <li class="has-submenu">
                 <a href="#">
                     <i class="md md-settings"></i>Definitions</a>
                 <ul class="submenu">
                     
                     <li><a href="item_add.php">Add Item</a></li>
                     <li style=""><a href="category_add.php">Add Category</a></li>
                     <li><a href="department_add.php">Add Court/Office/Others</a></li>
                     <li><a href="employee_add.php">Add Employee</a></li>
                     <li><a href="supplier_add.php">Add Vendor</a></li>
                     <li style="border-bottom:1px solid gray;"><a href="users.php">Add User</a></li>
                     <li><a href="backup.php">System Backup</a></li>
                 </ul>
             </li>

              <li class="has-submenu">
                 <a href="#">
                     <i class="md-trending-up"></i>Activity</a>
                 <ul class="submenu">
                  <li><a href="assets.php">Add Stock</a></li>
                 <li><a href="issue_assets.php">Deduct Stock</a></li>
                 </ul>
             </li>
                <li class="has-submenu">
                 <a href="#">
                     <i class="md-view-list"></i>Reports</a>
                 <ul class="submenu">
                      <li style="display:;"><a href="report_all.php">Datewise Report</a></li>
                      <li style="display:;"><a href="report_date_category_wise.php">Category / Item Wise Report</a></li>
                      <li><a href="report_date_department_wise_issue.php">Court/Office wise Report</a></li>
                      <li><a href="report_stock_items.php">Stock Items Report</a></li>
                       <li><a href="report_purchase_datewise.php">Purchase DateWise Report</a></li>
                 </ul>
             </li>
             
         </ul>
     </div>
 </div> 
</div> ';
}
else{

//     echo '<div class="navbar-custom">
//     <div class="container">
//         <div id="navigation">
//             <!-- Navigation Menu-->
//             <ul class="navigation-menu">
//                 <li class="has-submenu">
//                     <a href="index.php"><i class="md md-dashboard"></i>Dashboard</a>
               
//                 </li>
//                 <li class="has-submenu">
//                     <a href="#">
//                         <i class="md md-settings"></i>Definitions</a>
//                     <ul class="submenu">
                    
//                         <li><a href="add_demand.php">Add Demand</a></li>
                       
//                     </ul>
//                 </li>
   
                
   
               
   
   
   
   
                 
//             </ul>
//         </div>
//     </div> 
//    </div> ';

}
?>
            





        </header>