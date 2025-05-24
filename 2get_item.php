
<?php
$all_val=0;
require_once('my_connection.php');
if ($_POST['category_id'] == 'All') {
    echo '<option value="All" selected>All</option>';
    $sql = mysqli_query($my_connection, "SELECT id, item_name FROM items");
    while ($row = mysqli_fetch_array($sql)) {
        $id = $row['id'];
        $item_name = $row['item_name'];
        echo '<option value="'.$id.'">'.$item_name.'</option>';
    }
} else {
    // Handle the case when a specific category is selected
    $category_id = $_POST['category_id']; 
    echo '<option value="All" selected>All</option>';
    $sql = mysqli_query($my_connection, "SELECT id, item_name FROM items WHERE category_id = '$category_id'");
    while ($row = mysqli_fetch_array($sql)) {
        $id = $row['id'];
        $item_name = $row['item_name'];
        echo '<option value="'.$id.'">'.$item_name.'</option>';
    }
    
}
?>
